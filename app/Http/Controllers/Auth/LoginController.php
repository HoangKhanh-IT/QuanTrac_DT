<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use AuthenticatesUsers;
use Session;

class LoginController extends Controller
{
    //protected $redirectTo = 'master';
    //
    public function getAuthLogin()
    {
        return view('admin.login');
    }

    // public function __construct()
    // {
    //     $this->middleware('guest')->except('logout');
    // }

    public function postAuthLogin(Request $request)
    {

        $request->validate(
            [
                'username' => 'required',
                'password' => 'required'
            ],
            [
                'username.required' => 'Nhập tài khoản!',
                'password.required' => 'Nhập mật khẩu!'
            ]
        );
        $arr = [
            'username' => $request->username,
            'password' => $request->password
        ];
        $remember = $request->has('remember') ? true:false;
        if (Auth::attempt($arr,$remember)) {
            //return $next($request);
            return redirect()->route('master');
        } else {
            return redirect('/login')->with('error', 'Tài khoản hoặc mật khẩu không đúng!');

            dd('Not Ok');
        }
    }

    public function getLogout()
    {
        Auth::logout();
        return redirect('login');
    }
}
