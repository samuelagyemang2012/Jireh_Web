<?php

namespace App\Http\Controllers;

use App\Loan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class profilecontroller extends Controller
{
    public function index()
    {
        $loan = new Loan();
        $email = Session::get('email');

        $ploans = $loan->get_client_pending_loan_details($email);
        $aloans = $loan->get_client_approved_loan_details($email);
        $rloans = $loan->get_client_refused_loan_details($email);


        $numloans = $loan->get_num_loans();
        $pending = $loan->get_num_pending_loans($email);
        $approved = $loan->get_num_approved_loans($email);
        $refused = $loan->get_num_refused_loans($email);

//        return $ploans;


        return view('user_views.profile')
            ->with('ploans', $ploans)
            ->with('aloans', $aloans)
            ->with('rloans', $rloans)
            ->with('numloans', $numloans)
            ->with('pending', $pending)
            ->with('approved', $approved)
            ->with('refused', $refused);
    }
}
