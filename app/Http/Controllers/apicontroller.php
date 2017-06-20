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

        if ($uniques == 0) {

            $dob = preg_replace('/\s+/', '-', $inputs['date_of_birth']);

            $npass = bcrypt($inputs['password']);

            $today = date("l jS \of F Y h:i:s A");

            $user->insert($inputs['surname'], $inputs['firstname'], $inputs['othernames'], $npass, $inputs['email'], "test", $today);
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
        if ($request->hasFile('userImage')) {

            return response()->json([
                "msg" => "has file"
            ]);

        } else {
            return response()->json([
                "msg" => "no file"
            ]);
        }

//        if (is_array($_FILES)) {
//
//            if (is_uploaded_file($_FILES['userImage']['tmp_name'])) {
//
//                $sourcePath = $_FILES['userImage']['tmp_name'];
//                $targetPath = "uploads/" . $_FILES['userImage']['name'];
//                move_uploaded_file($sourcePath, $targetPath);
//
//                return response()->json([
//                    "msg" => "done"
//                ]);
//            }
//        } else {
//            return response()->json([
//                "msg" => "null"
//            ]);
//        }
//    }

//}


//        if (isset($_FILES["file"]["type"])) {
//
//            $validextensions = array("jpeg", "jpg", "png");
//
//            $temporary = explode(".", $_FILES["file"]["name"]);
//
//            $file_extension = end($temporary);
//
//            if ((($_FILES["file"]["type"] == "image/png") || ($_FILES["file"]["type"] == "image/jpg") || ($_FILES["file"]["type"] == "image/jpeg")
//                ) && ($_FILES["file"]["size"] < 100000)//Approx. 100kb files can be uploaded.
//                && in_array($file_extension, $validextensions)
//            ) {
//
//                if ($_FILES["file"]["error"] > 0) {
//
////            echo "Return Code: " . $_FILES["file"]["error"] . "<br/><br/>";
//
//                    return response()->json([
//                        "msg" => "error"
//                    ]);
//
//                } else {
////            if (file_exists("uploads/" . $_FILES["file"]["name"])) {
////                echo $_FILES["file"]["name"] . " <span id='invalid'><b>already exists.</b></span> ";
////            } else {
//                    $sourcePath = $_FILES['file']['tmp_name']; // Storing source path of the file in a variable
//                    $targetPath = "uploads/" . $_FILES['file']['name']; // Target path where file is to be stored
//                    move_uploaded_file($sourcePath, $targetPath); // Moving Uploaded file
//
//                    return response()->json([
//                        "msg" => "done"
//                    ]);
////                    echo "<span id='success'>Image Uploaded Successfully...!!</span><br/>";
////                    echo "<br/><b>File Name:</b> " . $_FILES["file"]["name"] . "<br>";
////                    echo "<b>Type:</b> " . $_FILES["file"]["type"] . "<br>";
////                    echo "<b>Size:</b> " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
////                    echo "<b>Temp file:</b> " . $_FILES["file"]["tmp_name"] . "<br>";
//                }
//            }
//        }else{
//            return response()->json([
////                "code" => 1,
//                "msg" => "null"
//            ]);
//        }
    }
}
