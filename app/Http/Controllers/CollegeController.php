<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CollegeController extends Controller
{
    public function index()
{
    $colleges = College::all();
    return response()->json($colleges);
}
}
