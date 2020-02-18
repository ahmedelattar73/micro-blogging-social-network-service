<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tweet extends Model
{

    protected $fillable = [
        'tweet_body',
    ];

    public function author() {
        return $this->belongsTo(User::Class, 'user_id');
    }
}
