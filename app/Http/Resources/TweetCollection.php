<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class TweetCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'data' => $this->collection->transform(function ($tweet) {
                return [
                    'id'            => $tweet->id,
                    'tweet_body'    => $tweet->tweet_body,
                    'created_at'    => $tweet->created_at,
                    'author'        => new UserResource($tweet->author)
                ];
            }),
            'links' => [
                'self' => 'link-value',
            ],
        ];
    }
}
