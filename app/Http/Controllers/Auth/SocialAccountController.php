<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Socialite;
use App\SocialAccountsService;
class SocialAccountController extends Controller
{

/**
     * Redirect the user to the GitHub authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToProvider($provider)
    {

        return Socialite::driver($provider)->redirect();
    }

      /**
     * Obtain the user information from GitHub.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback(SocialAccountsService $profileService ,$provider)
    {
          try{
            $user = Socialite::driver($provider)->user();

        }catch(\Exception $e){

            return redirect()->to('login');

            }


        $authUser = $profileService->findOrCreate($user,$provider);

           auth()->login($authUser,true);
            return redirect()->to('/');
        // $user->token;
    }
}


