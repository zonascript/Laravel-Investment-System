<?php

namespace App\Http\Controllers\Auth;

use App\BasicSetting;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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
    protected $redirectTo = '/user/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    protected function credentials(Request $request)
    {
        
        $basic = BasicSetting::first();
        if ($basic->verify_status == 0)
        {
            return ['email'=>$request->{$this->username()},'password'=>$request->password];
        }else{
            return ['email'=>$request->{$this->username()},'password'=>$request->password];
        }

    }
    public function logout(Request $request)
    {
        $this->guard()->logout();

        return redirect('/login');
    }
}
