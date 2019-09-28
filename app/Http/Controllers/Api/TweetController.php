<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTweet;
use Illuminate\Http\Request;
use App\Services\TweetService;
use App\Repositories\TweetRepository;


class TweetController extends Controller
{

    protected $tweetService;

    public function __construct(TweetService $tweetService)
    {
        $this->tweetService = $tweetService;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTweet $request)
    {
        $tweet = $this->tweetService->create($request);
        return response()->json(['success' => $tweet], 200);
    }


}
