<?php

namespace App\Http\Controllers;

use App\Loan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class profilecontroller extends Controller
{
    public function index()
    {
        $loan = new Loan;
        $email = Session::get('email');

        $loans = $loan->get_loan_details($email);

        return view('user_views.profile')->with('loans', $loans);
    }
}
