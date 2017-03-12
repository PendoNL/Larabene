<?php namespace App\Http\Controllers\Auth;

use Laravel\Socialite\Contracts\Factory as Socialite;
use App\Http\Controllers\Controller;

class SocialAuth extends Controller
{

    public function __construct(Socialite $socialite)
    {
        $this->socialite = $socialite;
    }

    public function getSocialAuth($provider = null)
    {
        if (!config("services.$provider")) {
            abort('404'); //just to handle providers that doesn't exist
        }

        return $this->socialite->with($provider)->redirect();
    }


    public function getSocialAuthCallback($provider = null)
    {
        if ($user = $this->socialite->with($provider)->user()) {
            dd($user);
            // Hier moeten we iets doen met controlles van het User Model
        } else {
            return 'something went wrong';
        }
    }
}
