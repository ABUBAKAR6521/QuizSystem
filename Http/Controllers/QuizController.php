<?php

namespace App\Http\Controllers;

use App\Awnser;
use App\Catagory;
use App\Http\Requests\QuizStoreRequest;
use App\Question;
use App\Quiz;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
class QuizController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $Quizez = Quiz::with('category')->latest()->paginate(10);
        return view('quizes.index', compact('Quizez'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Catagory::pluck('catagory_name', 'id');
        return view('quizes.add', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(QuizStoreRequest $request)
    {
        $slug = Str::slug($request->quiz_title);
        Quiz::create([
            'catagory_id'    => $request->category_id,
            'title'          => $request->quiz_title,
            'slug'          => $slug,
            'status'         => $request->quiz_status,
            'no_questions'   => $request->no_questions,
            'description'    => $request->quiz_description,
            'duration'       => $request->quiz_duration,
        ]);
        return redirect()->route('quizes.index')->with('msg', 'Quiz Created Successfully');
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
        $Quiz = Quiz::find($id);
        if (!empty($Quiz)) {
            $categories     =   Catagory::get();
            return view('quizes.edit', compact('Quiz', 'categories'));
        } else {
            return redirect()->route('quizes.index')->with('msg', 'Quiz not found');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(QuizStoreRequest $request, $id)
    {
        $slug = Str::slug($request->quiz_title);
        $Quiz = Quiz::find($id);
        if (!empty($Quiz)) {
            $Quiz->update([
                'catagory_id'    => $request->category_id,
                'title'          => $request->quiz_title,
                'status'         => $request->quiz_status,
                'slug'         => $slug,
                'no_questions'   => $request->no_questions,
                'description'    => $request->quiz_description,
                'duration'       => $request->quiz_duration,
            ]);
            return redirect()->route('quizes.index')->with('msg', 'Quiz updated succesfully');
        } else {
            return Redirect()->route('quizes.index')->with('msg', 'Quiz not found');
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
        $Quiz = Quiz::find($id);
        if (!empty($Quiz)) {
            $Quiz->delete();
            Question::where('quiz_id', $id)->delete();
            Awnser::where('quiz_id', $id)->delete();
            return redirect()->route('quizes.index')->with('msg', 'Quiz Deleted Successfully');
        } else {
            return redirect()->route('quizes.index')->with('msg', 'Quiz not found');
        }
    }
}
