<?php

//header('Access-Control-Allow-Origin: *');


namespace App\Http\Controllers;

use App\Client;
use App\Employer;
use App\Loan;
use App\Log;
use App\Spouse;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class apicontroller extends Controller
{
    public function login($email, $password)
    {
        $u = new User();

        $response = $u->login($email, $password);

        if ($response == 1) {

            session()->put('memail', $email);

            return response()->json([
                "code" => 1
            ]);

        } else {

            return response()->json([
                "code" => 0
            ]);

        }
    }

    public function sign_up(Request $request)
    {

        $client = new Client;
        $user = new User;
        $spouse = new Spouse;
        $employer = new Employer;
        $log = new Log;

        $inputs = $request->all();

//        $rules = [
//            'surname' => 'required|min:2',
//            'firstname' => 'required|min:2',
//            'othername' => 'min:2',
////            'spousename' => 'min:2',
////            'saddress' => 'min:5',
////            'stel' => 'min:10',
////            'soccup' => 'min:2',
//            'num_children' => 'required|min:0',
//            'residential_address' => 'required|min:6',
//            'mailing_address' => 'required|min:6',
//            'telephone_mobile' => 'required|min:10',
//            'telephone_official' => 'required|min:10',
//            'email' => 'required|min:6|unique:users',
//            'occupation' => 'required|min:5',
//            'position' => 'required|min:2',
//            'nationality' => 'required|min:5',
//            'numyears' => 'required|min:1',
//            'employer_name' => 'required|min:5',
//            'employer_address' => 'required|min:5',
//            'identification_number' => 'required|min:5',
//            'issuedate' => 'required',
//            'expirydate' => 'required',
//            'hometown' => 'required|min:5',
//            'social_security' => 'required|min:5|unique:clients',
//            'numhousehold' => 'required|min:0',
//            'numdependants' => 'required|min:0',
//            'father' => 'required|min:2',
//            'mother' => 'required|min:2',
//            'kname' => 'required|min:2',
//            'kaddress' => 'required|min:2',
//            'ktel' => 'required|min:10',
//            'krel' => 'required|min:3',
////            'username' => 'required|min:6|unique:users',
//            'password' => 'required|min:6',
//            'cpassword' => 'required|same:password',
//            'pic' => 'required'
//        ];
//
//        $messages = [
//            'surname.required' => 'The Surname field is required',
//            'surname.min' => 'The Surname field must be at least 2 characters.',
//
//            'firstname.required' => 'The First Name field is required',
//            'firstname.min' => 'The First Name field must be at least 2 characters.',
//
////            'spousename.min' => 'The Name of Spouse field must be at least 2 characters.',
////            'saddress.min' => 'The Spouse Address field must be at least 5 characters',
////            'stel.min' => 'A telephone number must be at least 10 characters',
//
//            'num_children.required' => 'The Number of Children field is required',
//            'num_children.min' => 'Number of Children field cannot be negative',
//
//            'residential_address.required' => 'The Residential Address field is required',
//            'residential_address.min' => 'The Residential Address field must be at least 6 characters',
//
//            'mailing_address.required' => 'The Mailing Address field is required',
//            'mailing_address.min' => 'The Mailing Address field must be at least 6 characters',
//
//            'telephone_mobile.required' => 'The Telephone (Mobile) field is required',
//            'telephone_mobile.min' => 'A telephone number must be at least 10 characters',
//
//            'telephone_official.required' => 'The Telephone (Official) field is required',
//            'telephone_official.min' => 'A telephone number must be at least 10 characters',
//
//            'email.required' => 'The Email field is required',
//            'email.min' => 'The Email field must be at least 6 characters',
//            'email.unique' => 'This email already exists !',
//
//            'occupation.required' => 'The Occupation field is required',
//            'occupation.min' => 'The Occupation field must be at least 5 characters',
//
//            'nationality.required' => 'The Nationality field is required',
//            'nationality.min' => 'The Nationality field must be at least 5 characters',
//
//            'employer_name.required' => 'The Employer Name is required',
//            'employer_name.min' => 'The Employer Name field must be at least 5 characters',
//
//            'employer_address.required' => 'The Employer Address is required',
//            'employer_address.min' => 'The Employer Adress field must be at least 5 characters',
//
//            'identification_number.required' => 'The Identification number field is required',
//            'identification_number.min' => 'The Identification Number field must be at least 5 characters',
//
//            'issuedate.required' => 'The Date of Issue is required',
//
//            'expirydate.required' => 'The Expiry date field is required',
////            'expirydate.min' => 'required|min:2',
//
//            'hometown.required' => 'The Hometown field is required',
//            'hometown.min' => 'The Hometown field must be at least 5 characters',
//
//            'social_security.required' => 'The Social Security Number field is required',
//            'social_security.min' => 'The Social Security field must be at least 5 characters',
//            'social_security.unique' => 'This Social Security Number already exist',
//
//            'numhousehold.required' => 'The Number of Members in Household is required ',
//            'numhousehold.min' => 'Number of Members in Household cannot be negative',
//
//            'numdependants.required' => 'The Number of Dependants is required',
//            'numdependants.min' => 'Number of Dependants field cannot be negative',
//
//            'father.required' => 'The Father field is required',
//            'father.min' => 'The Father field must be at least 2 charatcters',
//
//            'mother.required' => 'The Mother field is required',
//            'mother.min' => 'The Mother field must be at least 2 charatcters',
//
//            'kname.required' => 'The Next of Kin\'s Name field is required',
//            'kname.min' => 'The Next of Kin\'s Name field must be at least 2 characters',
//
//            'kaddress.required' => 'The Next of Kin\'s Address field is required',
//            'kaddress.min' => 'The Next of Kin\'s Address field must be at least 2 characters',
//
//            'ktel.required' => 'The Next of Kin\'s Telephone Number field is required',
//            'ktel.min' => 'A telephone number must be at least 10 characters',
//
//            'krel.required' => 'The Relationship with Next of Kin field is required',
//            'krel.min' => 'The Relationship with Next of Kin field must be at least 3 characters',
//
//            'password.required' => 'The Password field is required',
//            'password.min' => 'The Password field should be at least 6 characters',
//
//            'cpassword.required' => 'The Confirm Password field is required',
//            'cpassword.same' => 'Both passwords must match.',
//
//            'pic.required' => 'The Picture Field is required'
//        ]

        if ($inputs['agree'] == 1) {

            $uniques = $user->get_uniques($inputs['email'], $inputs['social_security']);

            if ($uniques == 0) {

                $dob = preg_replace('/\s+/', '-', $inputs['date_of_birth']);
//                $d = $dob[2]+"-"+$dob[1]+"-"+$dob[0];

                $npass = bcrypt($inputs['password']);

                $today = date("l jS \of F Y h:i:s A");

                $user->insert($inputs['surname'], $inputs['firstname'], $inputs['othernames'], $npass, $inputs['email'], "test", $today);
                $spouse->insert($inputs['email'], $inputs['spousename'], $inputs['saddress'], $inputs['stel']);
                $employer->insert($inputs['email'], $inputs['employer_name'], $inputs['employer_address']);
                $client->insert($inputs['email'], $inputs['title'], $inputs['gender'], $inputs['num_children'], $inputs['residential_address'], $inputs['mailing_address'], $inputs['telephone_mobile'], $inputs['telephone_official'], $dob, $inputs['occupation'], $inputs['position'], $inputs['nationality'], $inputs['numyears'], $inputs['marital_status'], $inputs['source_of_funds'], $inputs['monthly_income'], $inputs['identification'], $inputs['identification_number'], $inputs['issuedate'], $inputs['expirydate'], $inputs['literacy'], $inputs['hometown'], $inputs['social_security'], $inputs['numhousehold'], $inputs['numdependants'], $inputs['father'], $inputs['mother'], $inputs['kname'], $inputs['kaddress'], $inputs['ktel'], $inputs['krel']);

                $fname = $inputs['firstname'];
                $sname = $inputs['surname'];
//
                $msg = "" . $fname . " " . $sname . " created a new account.";
                $log->insert($msg, $inputs['email'], 'client');
//
//            For Mail
                $body = "You have successfully created an account with Jireh Microfinance Limited.";
                $sal = " ";

                $data = ["firstname" => $inputs['firstname'],
                    "surname" => $inputs['surname'],
                    "body" => $body,
                    "salutation" => $sal
                ];

                $this->mail($data, $inputs['email'], 'WELCOME TO JIREH MICROFINANCE LTD');

                return response()->json([
                    "code" => 0,
                    "msg" => "Client created"
                ]);

            } else {

                return response()->json([
                    "code" => 0,
                    "msg" => "Client not created"
                ]);

            }
        }
    }

    private function mail($data, $email, $subject)
    {
        Mail::send('email_views.email', $data, function ($m) use ($email, $subject) {
            $m->from('info@jirehmfl.com.gh', 'Jireh Microfinance Ltd');
            $m->to($email);
            $m->subject($subject);
        });
    }

    public function get_loans($email)
    {
        $l = new Loan;

        $data = $l->get_client_all_loans($email);

        return response()->json([
            "code" => 1,
            "data" => $data
        ]);
    }

    public function loan(Request $request)
    {
        $loan = new Loan;
        $log = new Log;
        $role = 'client';
//
        $inputs = $request->all();

//return $inputs;
        $date = date("l jS \of F Y h:i:s A");
        $email = Session::get('memail');
//        $rules = [
//            'num_monthly' => 'required|min:1',
//            'bank' => 'required|min:2',
//            'salary_date' => 'required',
//            'numloans' => 'required|min:0',
//            'total_monthly_payments' => 'required|min:0',
//            'name_insti' => 'required|min:2',
//            'amount' => 'required|min:1',
//            'loan_period' => 'required|min:1',
//            'purpose' => 'required|min:5',
//            'collateral' => 'required|min:5',
//            'wname' => 'required|min:2',
//            'wemployer' => 'required|min:2',
//            'wtel' => 'required|min:10'
//        ];
//
//        $messages = [
//            'num_monthly.required' => 'The Total Monthly Payments field is required',
//            'num_monthly.min' => 'The Total Monthly Payments field must be at least 1',
//
//            'bank.required' => 'The Bank field is required',
//            'bank.min' => 'The Bank field must be at least 2 characters',
//
//            'salary_date.required' => 'The Salary Date field is required',
//
//            'numloans.required' => 'The Number of Current Loans field is required',
//            'numloans.min' => 'The Number of Current Loans field cannot be negative',
//
//            'total_monthly_payments.required' => 'The Total Monthly Payments field is required',
//            'total_montly_payment.min' => 'The Total Monthly Payments field cannot be negative',
//
//
//            'name_insti.required' => 'The Name of Institution field is required',
//            'name_insti.min' => 'The Name ofInstitution field must be at least 2 characters',
//
//            'amount.required' => 'The Amount field is required',
//            'amount.min' => 'The amount requested field cannot ne negative',
//
//            'loan_period.required' => 'The Proposed Loan Period field is required',
//            'loan_period.min' => 'The Proposed Loan Period field must be at least 2 characters',
//
//            'collateral.required' => 'The Collateral Details field is required',
//            'collateral.min' => 'The Collateral Details field must be at least 5 charaters',
//
//            'wname.required' => 'The Witness\' Name field is required',
//            'wname.min' => 'The Witness\' Name field must be at least 2 characters',
//
//            'wemployer.required' => 'The Witness\' Employer field is required',
//            'wemployer.min' => 'The Witness\' Employer field must be at least 2 character',
//
//            'wtel.required' => 'The Witness\' Telephone field is required',
//            'wtel.min' => 'The Witness\' Telephone must be at least 10 characters'
//        ];
//
//        $this->validate($request, $rules, $messages);
        if ($inputs['agree'] == 1) {
//            return $request->all();
            $loan->insert($email, $inputs['num_monthly'], $inputs['other_source'], $inputs['bank'], $inputs['salary_date'], $inputs['numloans'], $inputs['total_monthly_payments'], $inputs['name_insti'], $inputs['amount'], $inputs['loan_period'], $inputs['purpose'], $inputs['collateral'], $inputs['cash_service'], $inputs['wname'], $inputs['wemployer'], $inputs['wtel'], $date, 1);

            $msg = $email . " requested for a loan";
            $log->insert($msg, $email, $role);

            return response()->json([
                "code" => 1,
                "msg" => "Loan added"
            ]);

        } else {
            return response()->json([
                "code" => 0,
                "msg" => "Loan not added"
            ]);
        }
    }
}
