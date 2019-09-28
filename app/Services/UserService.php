<?php

namespace App\Services;

use App\Http\Requests\FollowUser;
use App\Repositories\UserRepository;

class UserService
{

    /**
     * TweetService constructor.
     * @param UserRepository $user
     */
    public function __construct(UserRepository $user)
    {
        $this->user = $user ;
    }

    /**
     * @param StoreTweet $request
     * @return mixed
     */
    public function follow(FollowUser $request)
    {
        $attributes = $request->all();
        return $this->user->follow($attributes);
    }


    public function timeLine($id)
    {
        return $this->user->getTimeLine($id);
    }



}