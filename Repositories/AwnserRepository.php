<?php
namespace App\Repositories;

use App\Awnser;
use App\Catagory;
use App\Interfaces\AwnserInterface;
use Illuminate\Support\Facades\Auth;

class AwnserRepository implements AwnserInterface
{
    public function index()
    {
        return Awnser::with('category')->latest()->paginate(10);
    }
    public function create()
    {
        return Catagory::get();;
    }
    public function loggedInUser()
    {
        return Auth::user();
    }

}
