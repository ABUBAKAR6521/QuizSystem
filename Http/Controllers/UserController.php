<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserStoreRequest;
use App\Interfaces\UserInterface;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public $UserRepository;
    public function __construct(UserInterface $interface)
    {
        $this->middleware('auth');
        $this->UserRepository = $interface;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $objUser = $this->UserRepository->all();
        if ($objUser->status == 1) {
            $users = $objUser->data;
            return view('users.index', compact('users'));
        } else {
            return redirect()->route('users.index')->with('msg', $objUser->message);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\UserStoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserStoreRequest $request)
    {

        $data = [
            'first_name'     => $request->get('user_first_name'),
            'last_name'      => $request->get('user_last_name'),
            'email'          => $request->get('user_email'),
            'password'       => Hash::make($request->get('user_password')),
            'phone'          => $request->get('user_phone'),
            'adress'         => $request->get('user_adress'),
            'created_by'     => Auth::id()
        ];
        $this->UserRepository->store($data);
        return redirect()->route('users.index')->with('success', 'User Created Successfully');
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
        $objUser    =   $this->UserRepository->edit($id);
        if ($objUser->status == 1) {
            $user   =   $objUser->data;
            if ($user->created_by == auth()->id()) {
            return view('users.edit', compact('user'));
            } else {
            return redirect()->route('users.index')->with('msg', 'User not related to login user.');
            }
        } else {
            return redirect()->route('users.index')->with('msg', $objUser->message);
        }
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\UserStoreRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = [
            'first_name'     => $request->get('user_first_name'),
            'last_name'      => $request->get('user_last_name'),
            'email'          => $request->get('user_email'),
            'phone'          => $request->get('user_phone'),
            'adress'         => $request->get('user_adress'),
        ];
        $objUser = $this->UserRepository->update($id, $data);
        if (($objUser->status == 1)) {
            return redirect()->route('users.index')->with('msg', $objUser->message);
        } else {
            return redirect()->route('users.index')->with('msg', $objUser->message);
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
        $objUser = $this->UserRepository->delete($id);
        if ($objUser->status == 1) {
            $user = $objUser->data;
            $user->delete();
            return redirect()->route('users.index')->with('msg', $objUser->message);
        }else{
            return redirect()->route('users.index')->with('msg',$objUser->message);
        }
    }
}
