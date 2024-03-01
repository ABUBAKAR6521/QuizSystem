<?php

namespace App\Http\Controllers;

use App\Awnser;
use App\Models\QuizAttempt;
use App\Quiz;
use App\QuizAttempt as AppQuizAttempt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuizAttemptController extends Controller
{
    public function index()
    {
        $quizes = Quiz::all();
        return view('main.welcome', compact('quizes'));
    }

    public function show($id)
    {
        $quiz = Quiz::find($id);

        if ($quiz) {
            return view('main.QuizDetails', compact('quiz'));
        } else {
            return redirect()->back();
        }
    }

    public function create($id)
    {
        $quiz = Quiz::find($id);
        if (!empty($quiz)) {
            return view('main.QuestionsAttempt',compact('quiz'));
         } else{
                return redirect()->back();
            }
            // dd($quiz->questions);
            // dd($quiz->answers);
            // $yu=  $quiz->user()->associate(Auth::user());
    }
    }
