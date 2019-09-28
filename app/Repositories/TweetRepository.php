<?php

namespace App\Repositories;

use App\Repositories\Interfaces\TweetRepositoryInterface;
use App\Tweet;

class TweetRepository implements TweetRepositoryInterface
{

    protected $tweet;

    /**
     * TweetRepository constructor.
     * @param Tweet $tweet
     */
    public function __construct(Tweet $tweet)
    {
        $this->tweet = $tweet;
    }

    /**
     * @param $attributes
     * @return mixed
     */
    public function create($attributes)
    {
        return $this->tweet->create($attributes);
    }

}