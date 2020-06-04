<?php

namespace App\Http\Controllers\User\Authentication;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Cookie;
use App\Model\User\User;
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


    /**
     * Get the failed login response instance.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function sendFailedLoginResponse(Request $request)
    {
        return redirect()->route('login')   
                         ->withInput($request->only(['email','password']))
                         ->withErrors(['error'=>'We can\'t find credentials.']);
    }

//override functions

     public function showLoginForm()
    {
    
    //check cookie for username
        if(!empty(Cookie::get('username'))){
            
            $cookie = Cookie::get('username');
           
            //check if cookie is in the user
             if(!empty($user = User::where('email',$cookie)->first())){ 
                //above condition returns collecion if no ->first()

                //return user email 
                return view('user/authentication/login')->with(['username' => $user->email]);
                //be careful when naming variables, it may override flashed data from validation
             }
        }
        return view('user/authentication/login');
    }
}
