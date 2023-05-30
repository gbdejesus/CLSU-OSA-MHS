<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/contact-list/{id}', 'Api\ContactController@getContactList');
Route::get('/conversation/{id}/{auth_id}', 'Api\ContactController@getMessages');
Route::post('/conversation/send', 'Api\ContactController@sendNewMessage');

Route::post('/management/search', 'Api\AdminManagementController@search');
Route::post('/management/save', 'Api\AdminManagementController@save');
Route::post('/management/upload', 'Api\AdminManagementController@upload');
Route::get('/management/show/{id}', 'Api\AdminManagementController@show');
Route::post('/management/delete/{id}', 'Api\AdminManagementController@delete');

Route::get('/items', 'Api\EvaluationController@getEvaluationItems');
Route::post('/save', 'Api\EvaluationController@save');

Route::get('/counselors', 'Api\ContactController@getCounselors');
Route::post('/counselor/select/{counselorId}/{userId}', 'Api\ContactController@selectCounselor');

Route::post('/submit/2fa', 'Api\TwoFactorVerificationController@submit');
Route::post('/reset/2fa', 'Api\TwoFactorVerificationController@reset');
