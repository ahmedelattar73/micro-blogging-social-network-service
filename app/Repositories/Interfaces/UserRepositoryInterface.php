<?php

namespace App\Repositories\Interfaces;


interface UserRepositoryInterface
{

    public function follow($attributes);
    public function getTimeLine($attributes);
    
}