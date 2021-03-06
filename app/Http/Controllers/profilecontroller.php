<?php

namespace App\Http\Controllers;

use App\Client;
use App\Loan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class profilecontroller extends Controller
{
    public function index()
    {
        $client = new Client;

        $loan = new Loan();

        $data = Auth::user();

        $email = $data['email'];

        if ($email == null) {
            return redirect('/jireh/login');
        } else {

            $user_data = $client->get_client_names($email);

            $fname = $user_data[0]->firstname;
            $sname = $user_data[0]->surname;
            $last = $user_data[0]->last_logged_in;

            $ploans = $loan->get_client_pending_loan_details($email);
            $aloans = $loan->get_client_approved_loan_details($email);
            $rloans = $loan->get_client_refused_loan_details($email);


            $numloans = $loan->get_num_all_client_loans($email);
            $pending = $loan->get_num_client_pending_loans($email);
            $approved = $loan->get_num_approved_client_loans($email);
            $refused = $loan->get_num_refused_client_loans($email);

            return view('user_views.profile')
                ->with('ploans', $ploans)
                ->with('aloans', $aloans)
                ->with('rloans', $rloans)
                ->with('numloans', $numloans)
                ->with('pending', $pending)
                ->with('approved', $approved)
                ->with('refused', $refused)
                ->with('fname', $fname)
                ->with('sname', $sname)
                ->with('last', $last);
        }
    }
}
