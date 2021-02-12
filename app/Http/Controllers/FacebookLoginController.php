<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Socialite;

class FacebookLoginController extends Controller {

    /**
     * Create a redirect method to facebook api.
     *
     * @return void
     */
    public function redirect() {
        return Socialite::driver('facebook')->redirect();
    }

    /**
     * Return a callback method from facebook api.
     *
     * @return callback URL from facebook
     */
    public function callback() {
        try {
            $user = Socialite::driver('facebook')->user();
            $create['name'] = $user->getName();
            $create['email'] = $user->getEmail();
            $create['provider_id'] = $user->getId();
            $userModel = new User;
            $createdUser = $userModel->addNew($create);
            Auth::loginUsingId($createdUser->id);
            return redirect()->route('home');
        } catch (Exception $e) {
            return redirect('redirect');
        }
    }

}
