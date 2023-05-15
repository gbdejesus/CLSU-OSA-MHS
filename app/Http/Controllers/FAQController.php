<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class FAQController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    public function index()
    {
        if (Auth::user()->role === 'ADMIN') {
            return redirect()->route('admin');
        }

        return view('faq')->with([
            'userRole' => session('role')
        ]);
    }
}
