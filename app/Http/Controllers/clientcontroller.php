<?php

namespace App\Http\Controllers;

use App\Log;
use Illuminate\Http\Request;
use App\User;
use App\Client;
use App\Employer;
use App\Spouse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;

//use Illuminate\Support\Facades\Input;

class clientcontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        return view('user_views.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
//        $data = Auth::user();

//        if ($data['email']) {
        return view('user_views.create_account');
//        } else {
//            return redirect('/jireh/login');
//        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        return $request->all();

//        $data = Auth::user();

//        if ($data['email'] != null) {

        $user = new User;
        $spouse = new Spouse;
        $employer = new Employer;
        $client = new Client;
        $log = new Log;

        $inputs = $request->all();

        $rules = [
            'surname' => 'required|min:2',
            'firstname' => 'required|min:2',
            'othername' => 'min:2',
//            'spousename' => 'min:2',
//            'saddress' => 'min:5',
//            'stel' => 'min:10',
//            'soccup' => 'min:2',
            'num_children' => 'required|min:0',
            'residential_address' => 'required|min:6',
            'mailing_address' => 'required|min:6',
            'telephone_mobile' => 'required|min:10',
//            'telephone_official' => 'required|min:10',
            'email' => 'required|min:6|unique:users',
            'occupation' => 'required|min:5',
            'position' => 'required|min:2',
            'nationality' => 'required|min:5',
//            'numyears' => 'required|min:1',
            'employer_name' => 'required|min:5',
            'employer_address' => 'required|min:5',
            'identification_number' => 'required|min:5',
            'issuedate' => 'required',
            'expirydate' => 'required',
            'hometown' => 'required|min:5',
//            'social_security' => 'required|min:5|unique:clients',
//            'numhousehold' => 'required|min:0',
            'numdependants' => 'required|min:0',
//            'father' => 'required|min:2',
//            'mother' => 'required|min:2',
            'kname' => 'required|min:2',
            'kaddress' => 'required|min:2',
            'ktel' => 'required|min:10',
            'krel' => 'required|min:3',
//            'username' => 'required|min:6|unique:users',
            'password' => 'required|min:6',
            'cpassword' => 'required|same:password',
            'pic' => 'required'
        ];

        $messages = [
            'surname.required' => 'The Surname field is required',
            'surname.min' => 'The Surname field must be at least 2 characters.',

            'firstname.required' => 'The First Name field is required',
            'firstname.min' => 'The First Name field must be at least 2 characters.',

//            'spousename.min' => 'The Name of Spouse field must be at least 2 characters.',
//            'saddress.min' => 'The Spouse Address field must be at least 5 characters',
//            'stel.min' => 'A telephone number must be at least 10 characters',

            'num_children.required' => 'The Number of Children field is required',
            'num_children.min' => 'Number of Children field cannot be negative',

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
//            'expirydate.min' => 'required|min:2',

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

            'pic.required' => 'The Picture Field is required'
        ];

        $this->validate($request, $rules, $messages);

        if ($inputs['agree'] == 1) {

            $npass = bcrypt($inputs['password']);

            $picture = Input::file('pic')->getClientOriginalName();

            $today = date("l jS \of F Y h:i:s A");
            $user->insert($inputs['surname'], $inputs['firstname'], $inputs['othernames'], $npass, $inputs['email'], $picture, $today);
            $spouse->insert($inputs['email'], $inputs['spousename'], $inputs['saddress'], $inputs['stel']);
            $employer->insert($inputs['email'], $inputs['employer_name'], $inputs['employer_address']);
            $client->insert($inputs['email'], $inputs['title'], $inputs['gender'], $inputs['num_children'], $inputs['residential_address'], $inputs['mailing_address'], $inputs['telephone_mobile'], $inputs['telephone_official'], $inputs['date_of_birth'], $inputs['occupation'], $inputs['position'], $inputs['nationality'], $inputs['numyears'], $inputs['marital_status'], $inputs['source_of_funds'], $inputs['monthly_income'], $inputs['identification'], $inputs['identification_number'], $inputs['issuedate'], $inputs['expirydate'], $inputs['literacy'], $inputs['hometown'], $inputs['social_security'], $inputs['numhousehold'], $inputs['numdependants'], $inputs['father'], $inputs['mother'], $inputs['kname'], $inputs['kaddress'], $inputs['ktel'], $inputs['krel']);

            if (Input::hasFile('pic')) {
                $file = Input::file('pic');
                $file->move('uploads', $file->getClientOriginalName());
            }

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

//            For sms
            $msg2 = "Hello " . $fname . " " . $sname . "," . "\n" . "You have successfully created an account with Jireh Microfinance Limited.";
            $this->send_sms($inputs['telephone_mobile'], $msg2);

            return redirect('/jireh/login')->with('status', 'Your account has been created successfully !');

        } else {
            return redirect('client/create')->with('status', 'You must agree with the terms and conditions !');
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
        curl_exec($curl);
        curl_close($curl);
    }


    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
