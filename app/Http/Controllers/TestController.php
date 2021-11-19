<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\Answer;
use App\Models\User;
use App\Models\Result;
use Session;
class TestController extends Controller
{
    public function index()
    {
        return view('test');
    }

    public function get_question()
    {
        $user = Session::get('user');
        $answer_count = Result::where('user_id', $user->id)->count();

        if ($answer_count < 20) {
            $answers = Result::where('user_id', $user->id)
                ->pluck('question_id')
                ->toArray();

            $question = Question::with('answers')
                ->whereHas('answers')
                ->whereNotIn('id', $answers)
                ->inRandomOrder()
                ->first();

            if ($question != null) {
                return view('partials.question', ['question' => $question]);
            }
        }

        $correct_answers = Result::where('user_id', $user->id)
            ->where('result', true)
            ->count();
        $wrong_answers = Result::where('user_id', $user->id)
            ->where('result', false)
            ->count();
        $skip_answers = Result::where('user_id', $user->id)
            ->whereNull('result')
            ->count();

        return view('partials.result', ['correct_answers' => $correct_answers, 'wrong_answers' => $wrong_answers, 'skip_answers' => $skip_answers]);
    }

    public function store_user(Request $request)
    {
        $user = new User();
        $user->name = $request->name;
        Session::put('user', $user);

        if ($user->save()) {
            $response = ['message' => 'Added Successfully!', 'status' => true];
            return Response()->json($response);
        }
        $response = ['message' => 'Unable to process!', 'status' => false];
        return Response()->json($response);
    }

    public function post_answer(Request $request)
    {
        $user = Session::get('user');
        if ($request->question_id == null) {
            $response = ['message' => 'Question not found', 'status' => false];
            return Response()->json($response);
        }
        $result = new Result();
        $result->user_id = $user->id;
        $result->question_id = $request->question_id;

        if ($request->answer_id != null) {
            $result->answer_id = $request->answer_id;
            $result->result = false;

            $ans = Answer::find($request->answer_id);
            if ($ans != null && $ans->is_correct == 1) {
                $result->result = true;
            }
        }
        $result->save();
        $response = ['message' => 'Next Question', 'status' => true];
        return Response()->json($response);
    }
}
