<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('token');
    }

    public function show($id)
    {
        return view('user.profile',['user'=>User::findOrFail($id)]);
    }
}
