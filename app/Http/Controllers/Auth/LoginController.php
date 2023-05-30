<?php

namespace App\Http\Controllers\Auth;

use App\Exceptions\AuthFailedException;
use App\Http\Controllers\Controller;
use App\Image as UserImage;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;


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
//    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    protected function authenticated(Request $request, $user)
    {
        if (Auth::user()->role === 'ADMIN') {
            return redirect()->route('admin');
        }

        return redirect('/home');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $image = UserImage::where('profileId', Auth::user()->id)->first();
            session(
                [
                    'name' => Auth::user()->name,
                    'email' => Auth::user()->email,
                    'role' => Auth::user()->role,
                    'avatar' => $image['content'] ?? '',
                    'admin_nav' => config('nav.admin')
                ]
            );

            if (Auth::user()->role === 'ADMIN') {
                return redirect()->intended('/admin');
            }

            return redirect()->intended('/home');
        }

        return back()->withErrors([
            'email' => 'Invalid Email Address or Password. Please try again!',
        ])->onlyInput('email');
    }

    public function logout()
    {
        if(Auth::check())
        {
            Auth::logout();
            return redirect('/');
        }
    }

    protected function sendFailedLoginResponse(Request $request)
    {
        throw ValidationException::withMessages([
            'username or password is incorrect!!!'
        ]);
//        throw new AuthFailedException;
//        return view('login')->with([
//            'message' => 'Invalid Email or Password. Please try again!'
//        ]);
//        throw ValidationException::withMessages([
//            $this->username() => [trans('auth.failed')],
//            'password' => [trans('auth.password')],
//        ]);
    }

    protected function redirectTo()
    {
        if (Auth::user()->role == 'ADMIN') {
            return '/admin';
        }
        return '/home';
    }

    public function counsellors()
    {
        return view('counsellors')->with([
            'userRole' => session('role')
        ]);
    }

    public function faq()
    {
        return view('faq')->with([
            'userRole' => session('role')
        ]);
    }


}
