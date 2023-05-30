<?php

namespace App\Http\Controllers\Admin;

use \DB;
use App\User;

use App\Http\Controllers\Admin\AdminController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class HomeController extends AdminController
{
    //
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['clients'] = DB::table('users')
            ->select('college', DB::raw('count(*) as total'))
            ->where('role', 'CLIENT')
            ->where('deleted_at', null)
            ->whereNotNull('college')
            ->groupBy('college')
            ->get();

        $data['counselors'] = DB::table('users')
            ->select('college', DB::raw('count(*) as total'))
            ->where('role', 'COUNSELOR')
            ->where('deleted_at', null)
            ->whereNotNull('college')
            ->groupBy('college')
            ->get();

        View::share('data', $data);
        return view('admin.home')->with([
            'data' => $data
        ]);
    }

    public function login()
    {
        return view('admin.login');
    }
}
