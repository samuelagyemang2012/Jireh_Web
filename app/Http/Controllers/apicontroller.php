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
use Illuminate\Support\Facades\Validator;

class apicontroller extends Controller
{
    public function login($email, $password)
    {
        $u = new User();

        $response = $u->login($email, $password);

        if ($response == 1) {

            session()->put('memail', $email);

            return response()->json([
                "code" => 1,
                "msg" => "Login successful"
            ]);

        } else {

            return response()->json([
                "code" => 9,
                "msg" => "Login failed"
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

        if (Input::hasFile('pic')) {

            $picture = Input::file('pic')->getClientOriginalName();
            $file = Input::file('pic');
            $file->move('uploads', $file->getClientOriginalName());

        } else {
            return response()->json([
                'code' => '14',
                'msg' => 'Picure failed to upload'
            ]);
        }

        $somearray = array();

        $rules = [
            'surname' => 'required|min:2',
            'firstname' => 'required|min:2',
            'residential_address' => 'required|min:2',
            'mailing_address' => 'required|min:2',
            'telephone_mobile' => 'required|min:10',
//            'telephone_official' => 'required|min:10',
            'email' => 'required|min:6|unique:users|email',
            'occupation' => 'required|min:2',
            'position' => 'required|min:2',
            'nationality' => 'required|min:2',
//            'numyears' => 'required|min:1',
            'employer_name' => 'required|min:2',
            'employer_address' => 'required|min:2',
            'identification_number' => 'required|min:2',
            'issuedate' => 'required',
            'expirydate' => 'required',
            'hometown' => 'required|min:2',
//            'social_security' => 'required|min:5|unique:clients',
//            'numhousehold' => 'required|min:0',
            'numdependants' => 'required|min:0',
//            'father' => 'required|min:2',
//            'mother' => 'required|min:2',
            'kname' => 'required|min:2',
            'kaddress' => 'required|min:2',
            'ktel' => 'required|min:10',
            'krel' => 'required|min:3',
            'password' => 'required|min:6',
            'cpassword' => 'required|same:password',
        ];

        $messages = [
            'surname.required' => 'The Surname field is required',
            'surname.min' => 'The Surname field must be at least 2 characters.',

            'firstname.required' => 'The First Name field is required',
            'firstname.min' => 'The First Name field must be at least 2 characters.',

            'residential_address.required' => 'The Residential Address field is required',
            'residential_address.min' => 'The Residential Address field must be at least 6 characters',

            'mailing_address.required' => 'The Mailing Address field is required',
            'mailing_address.min' => 'The Mailing Address field must be at least 6 characters',

            'telephone_mobile.required' => 'The Telephone (Mobile) field is required',
            'telephone_mobile.min' => 'A telephone number must be at least 10 characters',

            'telephone_official.required' => 'The Telephone (Official) field is required',
            'telephone_official.min' => 'A telephone number must be at least 10 characters',

            'email.required' => 'The Email field is required',
            'email.min' => 'The Email field must be at least 6 characters',
            'email.unique' => 'This email already exists !',
            'email.email' => 'This is not a valid email.',

            'occupation.required' => 'The Occupation field is required',
            'occupation.min' => 'The Occupation field must be at least 5 characters',

            'nationality.required' => 'The Nationality field is required',
            'nationality.min' => 'The Nationality field must be at least 5 characters',

            'employer_name.required' => 'The Employer Name is required',
            'employer_name.min' => 'The Employer Name field must be at least 5 characters',

            'employer_address.required' => 'The Employer Address is required',
            'employer_address.min' => 'The Employer Adress field must be at least 5 characters',

            'identification_number.required' => 'The Identification number field is required',
            'identification_number.min' => 'The Identification Number field must be at least 5 characters',

            'issuedate.required' => 'The Date of Issue is required',

            'expirydate.required' => 'The Expiry date field is required',

            'hometown.required' => 'The Hometown field is required',
            'hometown.min' => 'The Hometown field must be at least 5 characters',

            'social_security.required' => 'The Social Security Number field is required',
            'social_security.min' => 'The Social Security field must be at least 5 characters',
            'social_security.unique' => 'This Social Security Number already exist',

            'numhousehold.required' => 'The Number of Members in Household is required ',
            'numhousehold.min' => 'Number of Members in Household cannot be negative',

            'numdependants.required' => 'The Number of Dependants is required',
            'numdependants.min' => 'Number of Dependants field cannot be negative',

            'father.required' => 'The Father field is required',
            'father.min' => 'The Father field must be at least 2 charatcters',

            'mother.required' => 'The Mother field is required',
            'mother.min' => 'The Mother field must be at least 2 charatcters',

            'kname.required' => 'The Next of Kin\'s Name field is required',
            'kname.min' => 'The Next of Kin\'s Name field must be at least 2 characters',

            'kaddress.required' => 'The Next of Kin\'s Address field is required',
            'kaddress.min' => 'The Next of Kin\'s Address field must be at least 2 characters',

            'ktel.required' => 'The Next of Kin\'s Telephone Number field is required',
            'ktel.min' => 'A telephone number must be at least 10 characters',

            'krel.required' => 'The Relationship with Next of Kin field is required',
            'krel.min' => 'The Relationship with Next of Kin field must be at least 3 characters',

            'password.required' => 'The Password field is required',
            'password.min' => 'The Password field should be at least 6 characters',

            'cpassword.required' => 'The Confirm Password field is required',
            'cpassword.same' => 'Both passwords must match.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {

            foreach ($validator->errors()->all() as $messages) {
                array_push($somearray, $messages . "\n");
            }

            return response()->json([
                "code" => "12",
                "msg" => $somearray
            ]);
        } else {

            $dob = preg_replace('/\s+/', '-', $inputs['date_of_birth']);

            $npass = bcrypt($inputs['password']);

            $today = date("l jS \of F Y h:i:s A");

            $user->insert($inputs['surname'], $inputs['firstname'], $inputs['othernames'], $npass, $inputs['email'], $picture, $today);

            $spouse->insert($inputs['email'], $inputs['spousename'], $inputs['saddress'], $inputs['stel']);
            $employer->insert($inputs['email'], $inputs['employer_name'], $inputs['employer_address']);
            $client->insert($inputs['email'], $inputs['title'], $inputs['gender'], $inputs['num_children'], $inputs['residential_address'], $inputs['mailing_address'], $inputs['telephone_mobile'], $inputs['telephone_official'], $dob, $inputs['occupation'], $inputs['position'], $inputs['nationality'], $inputs['numyears'], $inputs['marital_status'], $inputs['source_of_funds'], $inputs['monthly_income'], $inputs['identification'], $inputs['identification_number'], $inputs['issuedate'], $inputs['expirydate'], $inputs['literacy'], $inputs['hometown'], $inputs['social_security'], $inputs['numhousehold'], $inputs['numdependants'], $inputs['father'], $inputs['mother'], $inputs['kname'], $inputs['kaddress'], $inputs['ktel'], $inputs['krel']);

            $fname = $inputs['firstname'];
            $sname = $inputs['surname'];

            $msg = "" . $fname . " " . $sname . " created a new account.";
            $log->insert($msg, $inputs['email'], 'client');

//            For Mail
            $body = "You have successfully created an account with Jireh Microfinance Limited.";
            $sal = " ";

            $data = ["firstname" => $inputs['firstname'],
                "surname" => $inputs['surname'],
                "body" => $body,
                "salutation" => $sal
            ];

            $this->mail($data, $inputs['email'], 'WELCOME TO JIREH MICROFINANCE LTD');

//            For SMS
            $msg2 = "Hello " . $fname . " " . $sname . "," . "\n" . "You have successfully created an account with Jireh Microfinance Limited.";
            $this->send_sms($inputs['telephone_mobile'], $msg2);


            return response()->json([
                "code" => 0,
                "msg" => "Client created"
            ]);
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

    private function send_sms($number, $msg)
    {
        $message = urlencode($msg);
        $num = urlencode($number);

        $url = "http://deywuro.com/api/sms?username=jireh&password=pssjireh&source=Jireh&destination=" . $num . "&message=" . $message;

        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $var = curl_exec($curl);
        curl_close($curl);

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

        $inputs = $request->all();

        $date = date("l jS \of F Y h:i:s A");

        $email = Session::get('memail');

        $rules = [
            'num_monthly' => 'required|min:1',
            'bank' => 'required|min:2',
            'salary_date' => 'required',
            'numloans' => 'required|min:0',
            'total_monthly_payments' => 'required|min:0',
            'name_insti' => 'required|min:2',
            'amount' => 'required|min:1',
            'loan_period' => 'required|min:1',
            'purpose' => 'required|min:2',
            'collateral' => 'required|min:2',
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
            'collateral.min' => 'The Collateral Details field must be at least 2 charaters',

            'wname.required' => 'The Witness\' Name field is required',
            'wname.min' => 'The Witness\' Name field must be at least 2 characters',

            'wemployer.required' => 'The Witness\' Employer field is required',
            'wemployer.min' => 'The Witness\' Employer field must be at least 2 character',

            'wtel.required' => 'The Witness\' Telephone field is required',
            'wtel.min' => 'The Witness\' Telephone must be at least 10 characters'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        $somearray = array();

        if ($validator->fails()) {

            foreach ($validator->errors()->all() as $messages) {
                array_push($somearray, $messages . "\r\n");
            }

            return response()->json([
                "code" => '11',
                "msg" => $somearray
            ]);
        }

        if ($inputs['agree'] == 1) {

            $loan->insert($inputs['client_email'], $inputs['num_monthly'], $inputs['other_source'], $inputs['bank'], $inputs['salary_date'], $inputs['numloans'], $inputs['total_monthly_payments'], $inputs['name_insti'], $inputs['amount'], $inputs['loan_period'], $inputs['purpose'], $inputs['collateral'], $inputs['cash_service'], $inputs['wname'], $inputs['wemployer'], $inputs['wtel'], $date, 1);

            $msg = $inputs['client_email'] . " requested for a loan";
            $log->insert($msg, $inputs['client_email'], "client");

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

    public function upload(Request $request)
    {
        if ($request->hasFile('pics')) {

            return response()->json([
                "msg" => "true"
            ]);

        } else {

            return response()->json([
                "msg" => "false"
            ]);
        }
    }

    public function test(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'usernamet' => 'required',
            'password' => 'required|min:6'
        ]);

        $array = array();

        if ($validator->fails()) {

            foreach ($validator->errors()->all() as $messages) {

                array_push($array, $messages . "\r\n");
            }

            return response()->json([
                "code" => "9",
                "msg" => $array
            ]);
        }
    }
}
