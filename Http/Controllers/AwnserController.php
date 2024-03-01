<?php

namespace App\Http\Controllers;

use App\Awnser;
use App\Catagory;
use App\Http\Requests\AwnserStoreRequest;
use App\Interfaces\AwnserInterface;
use App\Question;
use App\Quiz;
use Illuminate\Http\Request;

class AwnserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public $AwnserRepository;
    public function __construct(AwnserInterface $interface)
    {
        $this->AwnserRepository = $interface;
    }
    public function index()
    {
        $awnsers= $this->AwnserRepository->index();
        return view('awnsers.index', compact('awnsers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = $this->AwnserRepository->create();
        return view('awnsers.add', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     *
      */
      public function store(AwnserStoreRequest $request)
      {
          $catagoryId    = $request->get('category_id');
          $quizId        = $request->get('quiz_id');
          $questionId    = $request->get('question_id');
          $isCorrect     = $request->input('is-correct');
          $maxAwnsers    = Question::find($questionId)->no_awnsers;
          if ($isCorrect && Awnser::where('question_id', $questionId)->where('is_correct', 1)->exists()) {
              return redirect()->route('awnsers.index')->with('msg','ERROR: Only one answer can be correct for this question.');
          };
          $AwnserCount = Awnser::where('category_id', $catagoryId)->where('quiz_id', $quizId)->where('question_id', $questionId)->count();
          if ($AwnserCount >= $maxAwnsers) {
              return redirect()->route('awnsers.index')->with('msg', 'Limit Exceeded: No More Awnsers can be added under this Question');
          }else{
            $awnser = new Awnser();
            $awnser->category_id = $request->get('category_id');
            $awnser->quiz_id = $request->get('quiz_id');
            $awnser->question_id = $request->get('question_id');
            $awnser->status = $request->get('status');
            $awnser->title = $request->get('title');
            $awnser->is_correct = $isCorrect ? '1' : '0';
            $awnser->description = $request->get('description');
            $awnser->save();
            return redirect()->route('awnsers.index')->with('msg', 'Answer Created Successfully');
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
        $awnser = Awnser::find($id);
        if (!empty($awnser)) {
            $category_id    =   isset($awnser->category_id) ? $awnser->category_id : '';
            $quiz_id        =   isset($awnser->quiz_id)     ? $awnser->quiz_id : '';
            $categories     =   Catagory::get();
            $quizes         =   Quiz::where('catagory_id', $category_id)->get();
            $questions      =   Question::where('quiz_id', $quiz_id)->get();

            return view('awnsers.edit', compact('awnser', 'categories', 'quizes', 'questions'));
        } else {
            return redirect()->route('awnsers.index')->with('msg', 'Error: Awnser Not Found');
        }
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\AwnserStoreRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AwnserStoreRequest $request, $id)
    {
        $catagoryId    = $request->get('category_id');
        $quizId        = $request->get('quiz_id');
        $questionId    = $request->get('question_id');
        $isCorrect     = $request->input('is-correct');
        $maxAwnsers    = Question::find($questionId)->no_awnsers;
        if ($isCorrect && Awnser::where('question_id', $questionId)->where('is_correct', 1)->exists()) {
            return redirect()->route('awnsers.index')->with('msg','ERROR: Only one answer can be correct for this question.');
        };
        $AwnserCount = Awnser::where('category_id', $catagoryId)->where('quiz_id', $quizId)->where('question_id', $questionId)->count();
        if ($AwnserCount <= $maxAwnsers) {
            $awnser = Awnser::find($id);
            if (!empty($id)) {
                $awnser->category_id     =  $request->get('category_id');
                $awnser->quiz_id         =  $request->get('quiz_id');
                $awnser->question_id     =  $request->get('question_id');
                $awnser->status          =  $request->get('status');
                $awnser->title           =  $request->get('title');
                $awnser->is_correct      =  $request->get('is-correct') ? '1' : '0';
                $awnser->description     =  $request->get('description');
                $awnser->update();
                return redirect()->route('awnsers.index')->with('msg', 'Awnser Updated Successfully');
            } else {
                return redirect()->route('awnsers.index')->with('msg', 'Error: Awnser Not Found');
            }
        }else{
            return redirect()->route('awnsers.index')->with('msg', 'Limit Exceeded: No More Awnsers can be added under this Question');
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
        if (!empty($id)) {
            $awnser = Awnser::find($id);
            $awnser->delete();
            return redirect()->route('awnsers.index')->with('msg', 'Awnser Deleted Successfully');
        } else {
            return redirect()->route('awnsers.index')->with('msg', 'Error: Awnser Not Found');
        }
    }


    public function questions($id)
    {
        if (!empty($id)) {
            $question =   Question::where('quiz_id', $id)->get();
            return response()->json([
                'status'    =>  'success',
                'message'   =>  'Success',
                'data'      =>  $question
            ]);
        } else {
            return response()->json([
                'status'    =>  'error',
                'message'   =>  'Error! Question id is required.',
                'data'      =>  [],
            ]);
        }
    }
}


