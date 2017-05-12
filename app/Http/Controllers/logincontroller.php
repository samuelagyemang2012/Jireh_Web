<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\User;

class logincontroller extends Controller
{
    public function index()
    {
        return view('user_views.index');
    }

    public function store(Request $request)
    {
//        echo "jack";
//        return $request->all();
        $user = new User;

        $inputs = $request->all();

        $user->login($inputs['username'],$inputs['lpassword']);

    }
}
