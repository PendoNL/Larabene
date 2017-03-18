<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    /**
     * @param $request
     * @param $user
     * @return mixed
     */
    public function authenticated($request, $user)
    {
        /* Check for active user
        if ($user->active == 0) {
            \Auth::logout();
            Flash::error('Uw account is nog niet geactiveerd.');

            return redirect(route('auth.login'));
        }*/

        return redirect()->intended(route('member.dashboard'));
    }
}
