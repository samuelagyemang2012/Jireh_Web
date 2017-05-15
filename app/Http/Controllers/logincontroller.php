<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\User;
use Illuminate\Support\Facades\Session;

session_start();

class logincontroller extends Controller
{
    public function index()
    {
        return view('user_views.index');
    }

    public function store(Request $request)
    {

        $user = new User;

        $inputs = $request->all();

        $res = $user->login($inputs['email'], $inputs['password']);

        if ($res == 0) {

            return redirect('login')->with('log', 'Invalid Login Details !');
        } else {
            return redirect('profile');
        }
    }
}
