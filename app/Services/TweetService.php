<?php

namespace App\Services;

use App\Http\Requests\StoreTweet;
use App\Repositories\TweetRepository;

class TweetService
{

    /**
     * TweetService constructor.
     * @param TweetRepository $tweet
     */
    public function __construct(TweetRepository $tweet)
    {
        $this->tweet = $tweet ;
    }

    /**
     * @param StoreTweet $request
     * @return mixed
     */
    public function create(StoreTweet $request)
    {
        $attributes = $request->all();
        return $this->tweet->create($attributes);
    }


    /**
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        return $this->tweet->delete($id);
    }

}