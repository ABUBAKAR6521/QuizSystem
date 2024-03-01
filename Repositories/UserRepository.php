<?php

namespace App\Repositories;

use App\Interfaces\UserInterface;
use App\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use stdClass;

class UserRepository implements UserInterface{
    public function all()
    {
        $result = new stdClass();
        try {
            $user =  User::where('id', '!=', Auth::id())->latest()->paginate(10);
            if(!empty($user)){
                $result->status = 1;
                $result->data = $user;
            }else{
                $result->status = 0;
                $result->message = 'Users not found';
                $result->data = null;
            }
        }catch (Exception $exception) {
            $result->status = 0;
            $result->message = $exception->getMessage();
            $result->data = null;
        }
        return $result;
    }
    public function store(array $data)
    {
        return User::create($data);
    }
    public function edit($id)
    {
        $result = new stdClass();
        try {
            $user = User::find($id);
            if (!empty($user)) {
                $result->status = 1;
                $result->message = 'Successfully fetch user detail';
                $result->data = $user;
            } else {
                $result->status = 0;
                $result->message = 'User not found!';
                $result->data = null;
            }
        } catch (Exception $exception) {
            $result->status = 0;
            $result->message = $exception->getMessage();
            $result->data = null;
        }
        return $result;
    }
    public function update($id, array $data)
    {
        $result = new stdClass();
        try {
            $user = User::find($id);
            if(!empty($user)){
                $result->status = 1;
                $result->message = 'User Updated Successfully';
                $result->data = $user;

                $user->update($data);
            }else{
                $result->status = 0;
                $result->message = 'User not Found';
                $result->data = null;
            }

        } catch (Exception $exception) {
            $result->status = 0;
            $result->message = $exception->getMessage();
            $result->data = null;
        }
        return $result;
    }
    public function delete($id)
    {
        $result = new stdClass();
        try {
            $user = User::find($id);
            if (!empty($user)) {
                if ($user->created_by == auth()->id()) {
                    $result->status = 1;
                    $result->message = 'User deleted successfully';
                    $result->data = $user;

                } else {
                    $result->status = 0;
                    $result->message = 'User not related to login user';
                    $result->data = null;
                }
            } else {
                $result->status = 0;
                $result->message = 'User not found';
                $result->data = null;
            }
        } catch (Exception $exception) {
            $result->status = 0;
            $result->message = $exception->getMessage();
            $result->data = null;
        }
        return $result;
    }

}

