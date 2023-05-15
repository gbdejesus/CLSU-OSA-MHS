<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::post('/authenticate', 'Auth\LoginController@authenticate')->name('authenticate');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/logout', 'Auth\LoginController@logout');

Route::get('/counsellors/guest', 'Auth\LoginController@counsellors');
Route::get('/faq/guest', 'Auth\LoginController@faq');
Route::get('/counsellors', 'CounsellorsController@index');
Route::get('/faq', 'FAQController@index');

// Routes for Admin
Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function () {
    Route::get('/home', function () { view('admin.home')->with(['userRole' => session('role')]); });
    Route::get('/', 'Admin\HomeController@index')->name('admin');
    Route::get('/user', 'Admin\UserController@index');
    Route::get('/colleges', 'Admin\CollegesController@index');
    Route::get('/faqs', 'Admin\FAQController@index');
});
