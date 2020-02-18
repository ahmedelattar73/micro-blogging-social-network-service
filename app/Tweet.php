<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tweet extends Model
{

    protected $fillable = [
        'tweet_body',
        'user_id',
    ];

    public function author() {
        return $this->belongsTo(User::Class, 'user_id');
    }
}
