<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Socialite;
use App\User;
use Auth;

class FacebookController extends Controller
{
    //
    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return Response
     */
    public function redirectToProvider()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function handleProviderCallback()
    {
        $user = Socialite::driver('facebook')->user();

        // $user->token;
        $data = [
            'name' => $user->getName(),
            'email' => $user->getEmail(),
            'password' => "123456",
        ];
     
        Auth::login(User::firstOrCreate($data));
        /*return redirect($this->redirectPath());*/

        
        
        return redirect('/');

        /*return $user->getName();*/
    }
}
