<?php

namespace App\Http\Controllers;

use App\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Loan;

class loancontroller extends Controller
{
    public function index()
    {
        $data = Auth::user();

        if ($data['email'] != null) {
            return view('user_views.loans');
        } else {
            return redirect('/jireh/login');
        }
    }

    public function store(Request $request)
    {
        $data = Auth::user();

        if ($data['email'] != null) {
//        return $request->all();
            $loan = new Loan;
            $log = new Log;
            $role = 'client';
//
            $inputs = $request->all();

            $date = date("l jS \of F Y h:i:s A");
            $email = Session::get('email');

            $rules = [
                'num_monthly' => 'required|min:1',
                'bank' => 'required|min:2',
                'salary_date' => 'required',
                'numloans' => 'required|min:0',
                'total_monthly_payments' => 'required|min:0',
                'name_insti' => 'required|min:2',
                'amount' => 'required|min:1',
                'loan_period' => 'required|min:1',
                'purpose' => 'required|min:5',
                'collateral' => 'required|min:5',
                'wname' => 'required|min:2',
                'wemployer' => 'required|min:2',
                'wtel' => 'required|min:10'
            ];

            $messages = [
                'num_monthly.required' => 'The Total Monthly Payments field is required',
                'num_monthly.min' => 'The Total Monthly Payments field must be at least 1',

                'bank.required' => 'The Bank field is required',
                'bank.min' => 'The Bank field must be at least 2 characters',

                'salary_date.required' => 'The Salary Date field is required',

                'numloans.required' => 'The Number of Current Loans field is required',
                'numloans.min' => 'The Number of Current Loans field cannot be negative',

                'total_monthly_payments.required' => 'The Total Monthly Payments field is required',
                'total_montly_payment.min' => 'The Total Monthly Payments field cannot be negative',


                'name_insti.required' => 'The Name of Institution field is required',
                'name_insti.min' => 'The Name ofInstitution field must be at least 2 characters',

                'amount.required' => 'The Amount field is required',
                'amount.min' => 'The amount requested field cannot ne negative',

                'loan_period.required' => 'The Proposed Loan Period field is required',
                'loan_period.min' => 'The Proposed Loan Period field must be at least 2 characters',

                'collateral.required' => 'The Collateral Details field is required',
                'collateral.min' => 'The Collateral Details field must be at least 5 charaters',

                'wname.required' => 'The Witness\' Name field is required',
                'wname.min' => 'The Witness\' Name field must be at least 2 characters',

                'wemployer.required' => 'The Witness\' Employer field is required',
                'wemployer.min' => 'The Witness\' Employer field must be at least 2 character',

                'wtel.required' => 'The Witness\' Telephone field is required',
                'wtel.min' => 'The Witness\' Telephone must be at least 10 characters'
            ];

            $this->validate($request, $rules, $messages);

            if ($inputs['agree'] == 1) {
//            return $request->all();
                $loan->insert($email, $inputs['num_monthly'], $inputs['other_source'], $inputs['bank'], $inputs['salary_date'], $inputs['numloans'], $inputs['total_monthly_payments'], $inputs['name_insti'], $inputs['amount'], $inputs['loan_period'], $inputs['purpose'], $inputs['collateral'], $inputs['cash_service'], $inputs['wname'], $inputs['wemployer'], $inputs['wtel'], $date, 1);

                $msg = $email . " requested for a loan";
                $log->insert($msg, $email, $role);

                return redirect('profile')->with('loan', 'Your loan application was successful !');
            } else {
//            echo 'false';
                return redirect('loan')->with('loan', 'You must agree with the terms and conditions');
            }
        } else {
            return redirect('/jireh/login');
        }
    }
}
