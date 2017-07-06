<?php

namespace App\Http\Controllers;


use App\Loan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\User;
use App\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

//session_start();

class logincontroller extends Controller
{
    public function index()
    {
        return view('user_views.index');
    }

    public function store(Request $request)
    {

        $user = new User;
        $log = new Log;


        $inputs = $request->all();

        $res = $user->login($inputs['email'], $inputs['password']);

        $urole = Session::get('urole');

        if ($res == 1 && $urole === 'user') {

            $date = date('l jS \of F Y h:i:s A');
            $user->update_last_login($inputs['email'], $date);

            $msg = $inputs['email'] . " logged in successfully";
            $log->insert($msg, $inputs['email'], 'client');

            return redirect('/jireh/profile');
        } else {

            $msg = $inputs['email'] . " failed to log in successfully";
            $log->insert($msg, $inputs['email'], 'client');

            return redirect('/jireh/login')->with('log', 'Invalid Login Details !');
        }
    }

    public function logout()
    {
        Auth::logout();
        Session::flush();

        return redirect('/jireh/login');
    }
}
