<?php

namespace App\Repositories;

use App\Repositories\Interfaces\UserRepositoryInterface;
use App\User;

class UserRepository implements UserRepositoryInterface
{

    protected $user;

    /**
     * UserRepository constructor.
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }


    public function create($attributes)
    {
        return $this->user->create($attributes);
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


    /**
     * @param $id
     * @return mixed
     */
    public function getTimeLine($id)
    {
        return $this->user->findOrfail($id)->timeline()->with('author')->paginate( config('pagination.count') );
    }

}
