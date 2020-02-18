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


}
