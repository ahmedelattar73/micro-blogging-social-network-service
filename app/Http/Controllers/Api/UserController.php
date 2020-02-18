<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\FollowUser;
use App\Http\Resources\TweetCollection;
use App\Services\UserService;

class UserController extends Controller
{

    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * @param FollowUser $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function follow(FollowUser $request)
    {
        $this->userService->follow($request);
        return response()->json(['message' => __('messages.success_follow')], 200);
    }

    public function timeline($id)
    {
        $tweets = $this->userService->timeLine($id);
        //Return api resource data as transformation layer.
        return  new TweetCollection( $tweets );
    }

}
