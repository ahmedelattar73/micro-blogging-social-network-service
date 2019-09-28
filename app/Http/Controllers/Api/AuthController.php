<?php

namespace App\Http\Controllers\Api;

use App\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\AuthRegister;
use Illuminate\Http\Request;

class AuthController extends Controller
{


    /**
     * @param AuthRegister $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(AuthRegister $request)
    {
        $validated          = $request->validated();
        $validated['image'] = uploadImage(180, 180, 'image', 'profiles');
        $user               = User::create($validated);
        $user->access_token = $user->createToken('app')->accessToken;
        return response()->json(['success' => $user], 200);
    }

}
