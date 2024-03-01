<?php

namespace App\Http\Controllers;

use App\Awnser;
use App\Catagory;
use App\Http\Requests\CatagoryStoreRequest;
use App\Question;
use App\Quiz;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Response;

class CategoryController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $catagories = Catagory::Latest()->paginate(10);
        return view('categories.index', compact('catagories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('categories.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\CatagoryStoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CatagoryStoreRequest $request)
    {
        $data   =   [
            'catagory_name'     =>  $request->catagory_name,
            'catagory_status'   =>  $request->catagory_status,
        ];
        $catagory   =   Catagory::create($data);
        if(!empty($catagory)) {
            return redirect()->route('categories.index')->with('msg', 'Catagory created succesfully');
        } else {
            return redirect()->route('categories.index')->with('msg', 'Catagory do not created succesfully');

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
        $catagory = Catagory::find($id);
        if (!empty($catagory)) {
            return view('categories.edit', compact('catagory'));
        } else {
            return Redirect()->route('categories.index')->with('msg', 'User not found');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\CatagoryStoreRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CatagoryStoreRequest $request, $id)
    {
        $catagory = Catagory::find($id);
        if (!empty($catagory)) {
            $data   =   [
                'catagory_name'     =>  $request->catagory_name,
                'catagory_status'   =>  $request->catagory_status,
            ];
            $catagory->update($data);
            return redirect()->route('categories.index')->with('success', 'Catagory updated succesfully');
        } else {
            return Redirect()->route('categories.index')->with('msg', 'User not found');
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
        $catagory = Catagory::find($id);
        if (!empty($catagory)) {
           $catagory->delete();
           Quiz::where('catagory_id',$catagory->id)->delete();
           Question::where('category_id',$catagory->id)->delete();
           Awnser::where('category_id',$catagory->id)->delete();
            return redirect()->route('categories.index')->with('msg', 'Catagory Delted Successfully');
        } else {
            return Redirect()->route('categories.index')->with('msg', 'User not found');
        }
    }

    /**
     * Get the specified resources from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function quizes($id)
    {
        if (!empty($id)) {
            $quizes =   Quiz::where('catagory_id', $id)->get();
            return response()->json([
                'status'    =>  'success',
                'message'   =>  'Success',
                'data'      =>  $quizes
            ]);
        } else {
            return response()->json([
                'status'    =>  'error',
                'message'   =>  'Error! Category id is required.',
                'data'      =>  [],
            ]);
        }
    }

    public function questions($id)
    {
        if (!empty($id)) {
            $question = Question::where('quiz_id', $id)->get();
            return response()->json([
                'status'    => 'success',
                'message'   => 'Success',
                'data'      => $question
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
