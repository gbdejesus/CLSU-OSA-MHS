<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $view = session('role') !== 'ADMIN' ? 'home' : 'admin.home';
        return view($view)->with([
            'userRole' => session('role')
        ]);
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
