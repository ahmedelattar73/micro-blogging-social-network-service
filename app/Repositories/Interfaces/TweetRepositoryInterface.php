<?php

namespace App\Repositories\Interfaces;


interface TweetRepositoryInterface
{

    public function create($attributes);

    public function delete($id);
    
}