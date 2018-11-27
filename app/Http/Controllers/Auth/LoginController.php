<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

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
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    public function redirectToProvider()
    {
        return Socialite::driver('facebook')->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback()
    {
        $user = Socialite::driver('facebook')->user();

        return $user->getEmail();
    }
    /**
     * make user can login by national id or email.
     *
     * @return void
     */
    protected function credentials(Request $request)
    {
        if(is_numeric($request->input('email'))){
            return ['national_id'=>$request->input('email'),'password'=>$request->input('password')];
        }
        elseif (filter_var($request->input('email'), FILTER_VALIDATE_EMAIL)) {
            return ['email' => $request->input('email'), 'password'=>$request->input('password')];
        }

    }
}
