<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthRegister;
use App\Http\Requests\AuthLogin;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Auth;
use App\User;

class AuthController extends Controller
{

    /**
     * @param AuthRegister $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(AuthRegister $request)
    {
        $validated          = $request->validated();
        $validated['image'] = uploadImage(180, 180, 'image', 'profiles');
        $user               = User::create($validated);
        $token              = JWTAuth::fromUser($user);

        return $this->respondWithToken($token, $user);
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
        if ($token = JWTAuth::attempt( $request->validated() )) {
            return $this->respondWithToken($token, auth()->user() );
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
            'data'          => $user,
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
