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

class EvaluationController extends Controller
{
    public function getEvaluationItems(Request $request)
    {
        $evaluation = Items::all();

        $newEvaluation = [];
        foreach ($evaluation as $eval) {
            $newOptions = [];
            foreach (json_decode($eval->options) as $option) {
                $option->answer = null;
                $newOptions[] = $option;
            }
            $eval->options = $newOptions;
            $newEvaluation[] = $eval;
        }

        return response()->json($newEvaluation);
    }

    public function save(Request $request)
    {
        $total = 0;
        foreach ($request->data as $item) {
            if (isset($item['answer'])) {
                $total += $item['answer'];
            }
        }

        $user = User::where('id', '=', $request->userId)->first();
        $user->evaluated = 1;
        $user->evaluation_score = $total;
        $user->evaluation_details = json_encode($request->data);
        $is_saved = $user->save();

        $response = [];
        $response['success'] = false;
        if ($is_saved) {
            $response['data'] = $user;
            $response['success'] = true;
        }

        return response()->json($response);
    }
}
