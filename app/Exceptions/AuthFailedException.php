<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Request;

class AuthFailedException extends Exception
{
    public function report($request)
    {
//        return response()->json([
//            'message'=>'Your credentials is incorrect'
//        ],422);

        print_r($request); die;

//         if ($exception instanceof AuthFailedException) {
//             return response()->view('errors.custom', [], 500);
//         }
//
//         return parent::render($request, $exception);


    }

}
