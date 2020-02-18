<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthRegister;
use App\Http\Requests\AuthLogin;
use App\Http\Resources\UserResource;
use App\Repositories\UserRepository;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Auth;
use App\User;


class AuthController extends Controller
{

    use AuthenticatesUsers;

    protected $userRepository;

    /**
     * 1- Inject userRepository.
     * 2- User login attemp limitation.
     *  Set ThrottlesLogins trait maxAttempts, decayMinutes attributes
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository   = $userRepository;
        $this->maxAttempts      = config('auth.login_attemp_count');
        $this->decayMinutes     = config('auth.login_attemp_throttle_time');
    }

    /**
     * @param AuthRegister $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(AuthRegister $request)
    {
        $user = $this->userRepository->create( $request->validated() );
        return $this->respondWithToken( JWTAuth::fromUser($user), $user );
    }

    /**
     * Get a JWT token via given credentials.
     *
     * @param AuthLogin $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(AuthLogin $request)
    {

        if ($this->hasTooManyLoginAttempts($request)) {

            $this->fireLockoutEvent($request);
            return response()->json(['error' => 'Too many logins'], 400);

        } elseif ($token = JWTAuth::attempt( $request->validated() )) {

            return $this->respondWithToken($token, auth()->user() );

        } else {
            $this->incrementLoginAttempts($request);
        }

        return response()->json(['error' => 'Unauthorized'], 401);
    }



    /**
     * Log the user out (Invalidate the token)
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        $this->guard()->logout();
        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     * @param  User $user
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token, User $user)
    {
        return response()->json([
            'data'          => new UserResource($user),
            'access_token'  => $token,
            'token_type'    => 'bearer',
            'expires_in'    => auth('api')->factory()->getTTL() * 60,
        ]);
    }

    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\Guard
     */
    public function guard()
    {
        return Auth::guard();
    }
}
