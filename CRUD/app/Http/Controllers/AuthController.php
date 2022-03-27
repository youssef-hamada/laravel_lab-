<?php

namespace App\Http\Controllers;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;

use Exception;

use App\models\User;




class AuthController extends Controller
{
    public function go(){
        return Socialite::driver('github')->redirect();
    }
    // public function rego(){
    //     $user = Socialite::driver('github')->user();
    //     return redirect('http://localhost/CRUD/CRUD/public/posts');
    // }
    

    public function redirectToGoogle()

    {

        return Socialite::driver('google')->redirect();
        // echo 'google';

    }
    public function handleGoogleCallback()

    {

        try {

            $user = Socialite::driver('google')->user();

            $finduser = User::where('google_id', $user->id)->first();

            if($finduser){

                Auth::login($finduser);

                 return redirect('http://localhost/CRUD/CRUD/public/posts');

            }else{

                $newUser = User::create([

                    'name' => $user->name,

                    'email' => $user->email,

              'google_id'=> $user->id

                ]);

                Auth::login($newUser);

                return redirect()->back();

            }

        } catch (Exception $e) {

            return redirect('http://localhost/CRUD/CRUD/public/posts/auth/google');

        }

    }


}
