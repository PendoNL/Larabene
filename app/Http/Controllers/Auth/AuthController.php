<?php

namespace App\Http\Controllers\Auth;

use URL;
use Auth;
use Input;
use Flash;
use Event;
use Session;
use Redirect;
use App\User;
use App\Group;
use Validator;
use Illuminate\Http\Request;
use App\Events\UserRegistered;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | registration & login controller
    |--------------------------------------------------------------------------
    |
    | this controller handles the registration of new users, as well as the
    | authentication of existing users. by default, this controller uses
    | a simple trait to add these behaviors. why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    protected $redirectPath = '/dashboard';

    /**
     * Create a new authentication controller instance.
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'getLogout']);
    }

    /**
     * Show the application login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function getLogin()
    {

        if (!session()->has('from')) {
            session()->put('from', redirect()->back()->getTargetUrl());
        }

        if (view()->exists('auth.authenticate')) {
            return view('auth.authenticate');
        }

        return view('auth.login');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
        ])->setAttributeNames([
            'name' => 'Naam',
            'email' => 'E-mail',
            'password' => 'Wachtwoord',
        ]);
    }

    /**
     * @param array $data
     * @return static
     */
    protected function create(array $data)
    {
        $data['password'] = bcrypt($data['password']);

        $user = User::create($data);

        return $user;
    }

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function getRegister()
    {
        return view('auth.register');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function postRegister(Request $request)
    {
        $validator = $this->validator($request->all());

        if ($validator->fails()) {
            $this->throwValidationException(
                $request,
                $validator
            );
        }
        
        Flash::success('U bent geregistreerd.');

        Auth::login($this->create($request->all()));

        return redirect(route('auth.login'));
    }
}
