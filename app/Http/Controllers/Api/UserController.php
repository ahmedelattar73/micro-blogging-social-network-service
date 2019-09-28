<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\FollowUser;
use App\Http\Requests\Timeline;
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
        return response()->json(['success' => __('messages.success_follow')], 200);
    }


    public function timeline($id)
    {
        $tweets = $this->userService->timeLine($id);
        return response()->json(['success' => $tweets], 200);
    }


}
