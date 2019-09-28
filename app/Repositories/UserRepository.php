<?php

namespace App\Repositories;

use App\Repositories\Interfaces\UserRepositoryInterface;
use App\User;

class UserRepository implements UserRepositoryInterface
{

    protected $user;

    /**
     * TweetRepository constructor.
     * @param Tweet $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }


    /**
     * @param $attributes
     * @return bool
     */
    public function follow($attributes)
    {
        $user = $this->user->find($attributes['user_id']);
        $isFollower = $user->isFollowedBy($attributes['follower_id']);

        if(! $isFollower) {
            $user->followers()->attach($attributes['follower_id']);
        }
        return  true;
    }

}