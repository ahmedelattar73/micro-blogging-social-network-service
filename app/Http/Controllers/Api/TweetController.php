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


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->tweetService->delete($id);
        return response()->json(['message' => __('messages.deleted')], 200);
    }
}
