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

        $uniques = $user->get_uniques($inputs['email'], $inputs['social_security']);

        if ($uniques != 0) {
            return response()->json([
                'code' => '12',
                'msg' => 'Your email or social security number is already taken'
            ]);
        }

        if ($uniques == 0) {

            if (Input::hasFile('pic')) {
                $picture = Input::file('pic')->getClientOriginalName();
                $file = Input::file('pic');
                $file->move('uploads', $file->getClientOriginalName());
            } else {
                $picture = 'test';
            }

            $validator = Validator::make($request->all(), [
                'surname' => 'required|min:2',
                'firstname' => 'required|min:2',
                'othername' => 'min:2',

                'residential_address' => 'required|min:6',
                'mailing_address' => 'required|min:6',
                'telephone_mobile' => 'required|min:10',
                'telephone_official' => 'required|min:10',
                'email' => 'required|min:6|unique:users',
                'occupation' => 'required|min:5',
                'position' => 'required|min:2',
                'nationality' => 'required|min:5',
                'numyears' => 'required|min:1',
                'employer_name' => 'required|min:5',
                'employer_address' => 'required|min:5',
                'identification_number' => 'required|min:5',
                'issuedate' => 'required',
                'expirydate' => 'required',
                'hometown' => 'required|min:5',
                'social_security' => 'required|min:5|unique:clients',
                'numhousehold' => 'required|min:0',
                'numdependants' => 'required|min:0',
                'father' => 'required|min:2',
                'mother' => 'required|min:2',
                'kname' => 'required|min:2',
                'kaddress' => 'required|min:2',
                'ktel' => 'required|min:10',
                'krel' => 'required|min:3',
//            'username' => 'required|min:6|unique:users',
                'password' => 'required|min:6',
                'cpassword' => 'required|same:password',
                'pic' => 'required'
            ]);

            if ($validator->fails()) {

                return response()->json([
                    "code" => '11',
                    "msg" => 'Please fill all required fields'
                ]);

            }

            $dob = preg_replace('/\s+/', '-', $inputs['date_of_birth']);

            $npass = bcrypt($inputs['password']);

            $today = date("l jS \of F Y h:i:s A");

            $user->insert($inputs['surname'], $inputs['firstname'], $inputs['othernames'], $npass, $inputs['email'], $picture, $today);

//            return response()->json([
//                'msg'=>'user insert'
//            ]);

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
        } else {
            return response()->json([
                "code" => 9,
                "msg" => "Client not created"
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

        $url = "http://deywuro.com:12111/api/sms?username=jireh&password=pssjireh&source=Jireh&destination=" . $num . "&message=" . $message;

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
        $input = $request->all();

        if (Input::hasFile('image')) {
            $file = Input::file('image');
            $file->move('uploads', $file->getClientOriginalName());
        }

        return response()->json([
            'data' => $input
        ]);
    }
}
