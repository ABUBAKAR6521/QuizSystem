<?php

namespace App\Http\Controllers;

use App\Awnser;
use App\Catagory;
use App\Http\Requests\QuestionStoreRequest;
use App\Question;
use App\Quiz;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $Questions = Question::with('quizes', 'catagory')->latest()->paginate(10);
        return view('questions.index', compact('Questions'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Catagory::get();
        return view('questions.add', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\QuestionStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(QuestionStoreRequest $request)
    {
        $categoryId     = $request->input('category_id');
        $quizId         = $request->input('quiz_id');
        $maxQuestions   = Quiz::find($quizId)->no_questions;
        $QuestionsCount = Question::where('category_id', $categoryId)->where('quiz_id', $quizId) ->count();
        if ($QuestionsCount < $maxQuestions) {
            $data = $request->only([
                'category_id',
                'quiz_id',
                'question_title',
                'question_status',
                'question_description',
                'no_awnsers',
            ]);
            $question = new Question($data);
            $question->save();
            return redirect()->route('questions.index')->with('msg', 'Question Created Successfully');
        }else{
            return redirect()->route('questions.index')->with('msg', 'ERROR: Cannot add more Questions related to this Quiz.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $Question = Question::find($id);
        if (!empty($Question)) {
            $category_id         =   isset($Question->category_id) ? $Question->category_id : '';
            $categories          =   Catagory::get();
            $quizes              =   Quiz::where('catagory_id', $category_id)->get();
            return view('questions.edit', compact('Question', 'categories', 'quizes'));
        } else {
            return redirect()->route('questions.index')->with('msg', 'Question not found');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\QuestionStoreRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(QuestionStoreRequest $request, $id)
    {
        $categoryId      = $request->input('category_id');
        $quizId          = $request->input('quiz_id');
        $maxQuestions    = Quiz::find($quizId)->no_questions;
        $QuestionsCount  = Question::where('category_id', $categoryId)->where('quiz_id', $quizId)->where('id', '!=', $id)->count();

        if ($QuestionsCount <= $maxQuestions) {
            $Question = Question::find($id);
            if (!empty($Question)) {
                $data = $request->only([
                    'category_id',
                    'quiz_id',
                    'question_title',
                    'question_status',
                    'question_description',
                    'no_awnsers',
                ]);
                $Question->update($data);
                return redirect()->route('questions.index')->with('msg', 'Question updated Successfully');
            } else {
                return redirect()->route('questions.index')->with('msg', 'No Question found');
            }
        }else{
                return redirect()->route('questions.index')->with('msg','limit Excceeded: No more questions can added ');
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $Question = Question::find($id);
        if (!empty($Question)) {
            $Question->delete();
            Awnser::where('question_id',$Question->id)->delete();
            return redirect()->route('questions.index')->with('msg', 'Question Deleted Successfully');
        } else {
            return redirect()->route('questions.index')->with('msg', 'Question not found');
        }
    }
}
