<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\FollowUser;
use App\Http\Resources\TweetCollection;
use App\Repositories\UserRepository;

class UserController extends Controller
{

    protected $userRepository;

    /**
     * UserController constructor.
     * @param UserRepository $user
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository ;
    }

    /**
     * @param FollowUser $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function follow(FollowUser $request)
    {
        $attribute = $request->validated();
        $attribute['follower_id'] = auth()->id();
        $this->userRepository->follow($attribute);
        return response()->json(['message' => __('messages.success_follow')], 200);
    }

    public function timeline()
    {
        $tweets = $this->userRepository->getTimeLine(auth()->id());
        return  new TweetCollection( $tweets );
    }

}
