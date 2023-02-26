<?php

namespace App\Http\Controllers\BackEnd;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function handleProviderCallback($provider)
    {
        $user = Socialite::driver($provider)->user();
        $existingUser = User::whereEmail($user->getEmail())->first();

        if ($existingUser) {
            Auth::login($existingUser);
        }else{
            $newUser = User::create([
                'role_id' => Role::where('slug','user')->first()->id,
                'name'    => $user->getName(),
                'email'   => $user->getEmail(),
                'status'  => true
            ]);

            //upload image
            // if ($user->getAvatar()) {
            //     $newUser->addMediaFromUrl($user->getAvatar())->toMediaCollection('avatar');
            // }
            Auth::login($newUser);
        }
        return redirect($this->redirectPath());
    }
}
