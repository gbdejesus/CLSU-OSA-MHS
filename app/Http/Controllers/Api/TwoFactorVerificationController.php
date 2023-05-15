<?php

namespace App\Http\Controllers\Api;

use App\Events\NewMessage;
use App\Message;
use App\User;
use Illuminate\Support\Facades\Auth;
use App\EvaluationOfUsers as Evaluation;
use App\Http\Controllers\Controller;
use App\EvaluationItems as Items;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Auth\RegisterController;

class TwoFactorVerificationController extends Controller
{
    public function submit(Request $request)
    {
        $params = $request->all();

        $user = User::findOrFail($params['userId']);

        $response = [];
        $response['success'] = false;
        $startTime = date("Y-m-d H:i:s");
        if ($params['code'] === $user->two_fa_code) {
            if ($startTime < $user->two_fa_expiry) { // validate
                $user->two_fa_code = null;
                $user->two_fa_expiry = null;
                $user->two_fa_verified = 1;

                $user->save();
                $response['data'] = $user;
                $response['success'] = true;
            } else {
                $response['data'] = $user;
                $response['message'] = 'Authentication Code is already Expired. Please request a new one.';
            }

            return response()->json($response);
        } else {
            $response['message'] = 'Authentication Code is Invalid. Please submit the right code.';
        }

        return response()->json($response);
    }

    public function reset(Request $request)
    {
        return app(\App\Http\Controllers\Auth\RegisterController::class)->sendTwoFactorEmail(User::findOrFail($request->userId));
    }

}
