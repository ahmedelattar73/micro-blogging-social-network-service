<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\FollowUser;
use App\Services\TweetService;
use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{


    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function follow(FollowUser $request)
    {
        $this->userService->follow($request);
        return response()->json(['success' => __('messages.success_follow')], 200);
    }


}
