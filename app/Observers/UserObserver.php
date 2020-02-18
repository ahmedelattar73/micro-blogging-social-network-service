<?php

namespace App\Observers;

use App\User;
use Carbon\Carbon;

class UserObserver
{

    /**
     * 1- Calculate user age from birth day.
     * 2- Upload image
     * @param User $user
     * @return void
     */
    public function saving(User $user)
    {
        $user->age   = Carbon::now()->diffInYears($user->birth_date);
        $user->image = uploadImage(request()->image, config('images.profile.width'), config('images.profile.height'));
    }

}
