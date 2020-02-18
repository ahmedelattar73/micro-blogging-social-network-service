<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTweet;
use App\Http\Resources\TweetResource;
use App\Repositories\TweetRepository;
use App\Tweet;

class TweetController extends Controller
{

    protected $tweetRepository;

    public function __construct(TweetRepository $tweetRepository)
    {
        $this->tweetRepository = $tweetRepository ;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTweet $request)
    {
        $attributes = $request->validated();
        $attributes['user_id'] = auth()->id();
        $tweet = $this->tweetRepository->create($attributes);
        return response()->json(new TweetResource($tweet), 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tweet $tweet)
    {
        $this->authorize('delete', $tweet);
        $this->tweetRepository->delete($tweet->id);
        return response()->json(null, 204);
    }
}
