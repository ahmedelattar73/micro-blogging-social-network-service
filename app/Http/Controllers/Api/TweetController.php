<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTweet;
use App\Http\Resources\TweetResource;
use App\Repositories\TweetRepository;


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
        $tweet = $this->tweetRepository->create($request->validated());
        return response()->json(new TweetResource($tweet), 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->tweetRepository->delete($id);
        return response()->json(null, 204);
    }
}
