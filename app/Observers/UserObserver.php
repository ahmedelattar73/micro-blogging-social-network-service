<?php

namespace App\Observers;

use App\User;
use Carbon\Carbon;

class UserObserver
{

    /**
     * @param User $user
     * @return void
     */
    public function saving(User $user)
    {
        // Calculate user age from birth day.
        $dt = Carbon::now();
        $user->age = $dt->diffInYears($user->birth_date);
    }

}
