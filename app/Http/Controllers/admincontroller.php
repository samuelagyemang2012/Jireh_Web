<?php

namespace App\Http\Controllers;

use App\Admin;
use App\Client;
use App\Employer;
use App\Loan;
use App\Spouse;
use App\User;
use App\Log;
use Dompdf\Adapter\PDFLib;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;
use PDF;

class admincontroller extends Controller
{
    public function index()
    {
        return view('admin_views.admin-login');
    }

    public function show()
    {
        $c = new Client;
        $l = new Loan;

        $all_pend = $l->get_all_pending_loans();

        $pending1 = $l->get_num_pending_loans();
        $approved = $l->get_num_approved_loans();
        $refused = $l->get_num_refused_loans();
        $all = $l->get_num_loans();

        return view('admin_views.pending')
            ->with('all_pend', $all_pend)
            ->with('pending1', $pending1)
            ->with('approved', $approved)
            ->with('refused', $refused)
            ->with('all', $all);
    }

    public function pending()
    {
        $l = new Loan;

        $all_pend = $l->get_all_pending_loans();

        $pending1 = $l->get_num_pending_loans();
        $approved = $l->get_num_approved_loans();
        $refused = $l->get_num_refused_loans();
        $all = $l->get_num_loans();

        return view('admin_views.pending')
            ->with('all_pend', $all_pend)
            ->with('pending1', $pending1)
            ->with('approved', $approved)
            ->with('refused', $refused)
            ->with('all', $all);
    }

    public function approved()
    {

        $l = new Loan;

        $pending1 = $l->get_num_pending_loans();
        $approved = $l->get_num_approved_loans();
        $refused = $l->get_num_refused_loans();
        $all = $l->get_num_loans();

        $aploans = $l->get_all_approved_loans();

//        return $aploans;
        return view('admin_views.approved')
            ->with('title', 'Approved Loans')
            ->with('aploans', $aploans)
            ->with('all', $all)
            ->with('pending', $pending1)->with('refused', $refused)->with('approved', $approved);

    }

    public function refused()
    {
        $l = new Loan;

        $pending1 = $l->get_num_pending_loans();
        $approved = $l->get_num_approved_loans();
        $refused = $l->get_num_refused_loans();
        $all = $l->get_num_loans();

        $rloans = $l->get_all_refused_loans();

//        return $aploans;
        return view('admin_views.refused')
            ->with('title', 'Approved Loans')
            ->with('rloans', $rloans)
            ->with('pending', $pending1)
            ->with('approved', $approved)
            ->with('refused', $refused)
            ->with('all', $all);
    }

    public function all()
    {
        $l = new Loan;

        $all_loans = $l->get_all_loans();

        $pending1 = $l->get_num_pending_loans();
        $approved = $l->get_num_approved_loans();
        $refused = $l->get_num_refused_loans();
        $all = $l->get_num_loans();


        return view('admin_views.all-loans')
            ->with('title', 'All Loans')
            ->with('pending', $pending1)
            ->with('refused', $refused)
            ->with('approved', $approved)
            ->with('all', $all)
            ->with('all_loans', $all_loans);
    }

    public function client_details(Request $request)
    {
        $c = new Client;
        $l = new Loan;

        $pending1 = $l->get_num_pending_loans();
        $approved = $l->get_num_approved_loans();
        $refused = $l->get_num_refused_loans();
        $all = $l->get_num_loans();

        $input = $request->all();
//        $input['email'];
        $data = $c->get_client_details($input['email'], $input['id']);

        return view('admin_views.client')
            ->with('data', $data[0])
            ->with('title', 'Client Details')
            ->with('pending', $pending1)
            ->with('approved', $approved)
            ->with('refused', $refused)
            ->with('all', $all);

    }

    public function approve_loan(Request $request)
    {
        $l = new Loan;
        $log = new Log;
        $u = new User;

        $input = $request->all();

        $l->approve_loan($input['id']);

        $email = Session::get('admin');

        $client = $l->get_loan_details_by_id($input['id']);
        $userdata = $u->get_user($client[0]->client_email);

        $date = explode(" ", $client[0]->created_at);

//        For mail
        $body = "Your loan request of GHC " . $client[0]->amount_requested . " on " . $date[0] . " has been approved.";
        $sal = "Please visit us for more details.";

        $data = ["firstname" => $userdata[0]->firstname,
            "surname" => $userdata[0]->surname,
            "body" => $body,
            "salutation" => $sal
        ];


        $msg = $email . " approved a loan by" . $client[0]->client_email;
        $log->insert($msg, $email, 'admin');

//        $this->mail($data, $client[0]->client_email,"LOAN APPROVAL");

        return redirect('/admin/dashboard');
    }

    public function refuse_loan(Request $request)
    {
        $l = new Loan;
        $log = new Log;
        $u = new User;

        $input = $request->all();

        $l->refuse_loan($input['id']);

        $email = Session::get('admin');

        $client = $l->get_loan_details_by_id($input['id']);
        $userdata = $u->get_user($client[0]->client_email);

        $date = explode(" ", $client[0]->created_at);

//        For mail
        $body = "Your loan request for GHC " . $client[0]->amount_requested . " on " . $date[0] . " has been refused.";
        $sal = "Please visit us for more details.";

        $data = ["firstname" => $userdata[0]->firstname,
            "surname" => $userdata[0]->surname,
            "body" => $body,
            "salutation" => $sal
        ];

        $msg = $email . " refused a loan by" . $client[0]->client_email;
        $log->insert($msg, $email, 'admin');

//        $this->mail($data, $client[0]->client_email,"LOAN REFUSAL");

        return redirect('/admin/dashboard');
    }

    public function store(Request $request)
    {
        $user = new User;
        $log = new Log;

        $input = $request->all();

        $res = $user->admin_login($input['email'], $input['password']);

        $role = Session::get('role');
        session()->put('admin', $input['email']);
        $email = Session::get('admin');

        if ($res == 1 && $role === 'admin') {

            $msg = $email . " logged in as admin sucessfully.";
            $log->insert($msg, $email, "admin");

            return redirect('admin\dashboard');

        } else {


            $msg = $email . " tried to log in as admin but failed.";
            $log->insert($msg, $email, "admin");

            return redirect('admin')->with('status', 'Invalid email or password');
//            echo 'false';
        }
    }

    public function show_admin_view()
    {
        return view('admin_views.create');
    }

    public function show_edit_details()
    {
        $aemail = Session::get('aemail');

        return view('admin_views.edit_admin')->with('aemail', $aemail);
    }

    public function add_admin(Request $request)
    {
        $inputs = $request->all();

        $rules = [
            'surname' => 'required|min:2',
            'firstname' => 'required|min:2',
            'email' => 'required|min:6|unique:users',
            'password' => 'required|min:6',
            'confirm_password' => 'required|same:password'
        ];

        $this->validate($request, $rules);

        $a = new Admin;
        $log = new Log;

        $npass = bcrypt($inputs['password']);

        $a->add_admin($inputs['surname'], $inputs['firstname'], $npass, $inputs['email'], 'admin');

        $email = Session::get('admin');
        $msg = $email . " created " . $inputs['email'] . " as a new admin";

        $log->insert($msg, $email, "admin");
//        $surname, $firstname, $password, $email, $role

        return redirect('/admin/dashboard')->with('New Admin Created successfully');
    }

    public function update(Request $request)
    {
        $client = new Client;

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
            'telephone_official' => 'required|min:10',
//            'email' => 'required|min:6|unique:users',
            'occupation' => 'required|min:5',
            'position' => 'required|min:5',
            'nationality' => 'required|min:5',
//            'numyears' => 'required|min:1',
            'employer_name' => 'required|min:5',
            'employer_address' => 'required|min:5',
            'identification_number' => 'required|min:5',
            'issuedate' => 'required',
            'expirydate' => 'required',
            'hometown' => 'required|min:5',
//            'social_security' => 'required|min:5|unique:clients',
            'numhousehold' => 'required|min:0',
            'numdependants' => 'required|min:0',
            'father' => 'required|min:2',
            'mother' => 'required|min:2',
            'kname' => 'required|min:2',
            'kaddress' => 'required|min:2',
            'ktel' => 'required|min:10',
            'krel' => 'required|min:3',
//            'username' => 'required|min:6|unique:users',
//            'password' => 'required|min:6',
//            'cpassword' => 'required|same:password',
//            'pic' => 'requir/ed'
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
            'password.min' => 'The Password field should be at least 6 characters'

//            'cpassword.required' => 'The Confirm Password field is required',
//            'cpassword.same' => 'Both passwords must match.',
//
//            'pic.required' => 'The Picture Field is required'
        ];

        $this->validate($request, $rules, $messages);

        $client->update_clients($inputs['email'], $inputs['title'], $inputs['gender'], $inputs['num_children'], $inputs['residential_address'], $inputs['mailing_address'], $inputs['telephone_mobile'], $inputs['telephone_official'], $inputs['date_of_birth'], $inputs['occupation'], $inputs['position'], $inputs['nationality'], $inputs['numyears'], $inputs['marital_status'], $inputs['source_of_funds'], $inputs['monthly_income'], $inputs['identification'], $inputs['identification_number'], $inputs['issuedate'], $inputs['expirydate'], $inputs['literacy'], $inputs['hometown'], $inputs['social_security'], $inputs['numhousehold'], $inputs['numdependants'], $inputs['father'], $inputs['mother'], $inputs['kname'], $inputs['kaddress'], $inputs['ktel'], $inputs['krel']);

        return redirect('/admin/dashboard')->with('status', 'Client details updated successfully.');
    }

    public function edit_admin(Request $request)
    {
        $log = new Log;
        $email = Session::get('email');
        $role = "admin";

        $inputs = $request->all();

        $sesion_email = Session::get('aemail');
//        session()->forget('aemail');

        $rules = [
//            'email' => 'required|min:6',
            'password' => 'required|min:6',
            'confirm_password' => 'required|same:password'
        ];

        $this->validate($request, $rules);

        $a = new Admin;

        $npass = bcrypt($inputs['password']);

        $a->update_admin_details($sesion_email, $inputs['email'], $npass);

//        session()->put('aemail', $inputs['email']);

        $msg = $sesion_email . " updated his email their credentials";
        $log->insert($msg, $sesion_email, $role);

        return redirect('/admin/dashboard')->with('status', 'Credentials Updated successfully');
    }

    private function loans_to_Array($loans)
    {
        $header[] = ['Surname', 'Firstname', 'Email', 'Telephone (Mobile)', 'Amount Requested'];

        foreach ($loans as $loan) {
            $header[] = array($loan->surname, $loan->firstname, $loan->email, $loan->telephone_mobile, $loan->amount_requested);
        }

        return $header;
    }

    public function export_excel(Request $request)
    {
        $inputs = $request->all();

        $this->to_excel($inputs['function'], $inputs['type']);

    }

    private function to_excel($function, $type)
    {
        $l = new Loan;
        $log = new Log;
        $email = Session::get('admin');
        $role = 'admin';

        if ($function === "all_loans") {

            $all_loans = $l->get_all_loans();

            $all_loans = $this->loans_to_Array($all_loans);

            $msg = $email . " exported all loans in the system as a " . $type . " file.";
            $log->insert($msg, $email, $role);

            Excel::create('All Loans', function ($excel) use ($all_loans) {

                $excel->setTitle('Payments');
                $excel->setCreator('Jireh Microfinance Ltd')->setCompany('Jireh Microfinance Ltd');
                $excel->setDescription('All Loans');

                $excel->sheet('All Loans', function ($sheet) use ($all_loans) {
                    $sheet->fromArray($all_loans, null, 'A1', false, false);
                });

            })->download($type);
        }

        if ($function === "pending") {

            $all_loans = $l->get_all_pending_loans();

            $all_loans = $this->loans_to_Array($all_loans);

            $msg = $email . " exported all pending Loans in the system as a " . $type . " file.";
            $log->insert($msg, $email, $role);

            Excel::create('Pending Loans', function ($excel) use ($all_loans) {

                $excel->setTitle('Pending Loans');
                $excel->setCreator('Jireh Microfinance Ltd')->setCompany('Jireh Microfinance Ltd');
                $excel->setDescription('All Loans');

                $excel->sheet('Pending Loans', function ($sheet) use ($all_loans) {
                    $sheet->fromArray($all_loans, null, 'A1', false, false);
                });

            })->download($type);

        }

        if ($function === "refused") {
            $all_loans = $l->get_all_refused_loans();

            $all_loans = $this->loans_to_Array($all_loans);

            $msg = $email . " exported all refused loans in the system as a " . $type . " file.";
            $log->insert($msg, $email, $role);

            Excel::create('Refused Loans', function ($excel) use ($all_loans) {

                $excel->setTitle('Refused Loans');
                $excel->setCreator('Jireh Microfinance Ltd')->setCompany('Jireh Microfinance Ltd');
                $excel->setDescription('Refused Loans');

                $excel->sheet('Refused Loans', function ($sheet) use ($all_loans) {
                    $sheet->fromArray($all_loans, null, 'A1', false, false);
                });

            })->download($type);
        }

        if ($function === "approved") {

            $all_loans = $l->get_all_approved_loans();

            $all_loans = $this->loans_to_Array($all_loans);

            $msg = $email . " exported all approved loans in the system as a " . $type . " file.";
            $log->insert($msg, $email, $role);

            Excel::create('Approved Loans', function ($excel) use ($all_loans) {

                $excel->setTitle('Approved Loans');
                $excel->setCreator('Jireh Microfinance Ltd')->setCompany('Jireh Microfinance Ltd');
                $excel->setDescription('Approved Loans');

                $excel->sheet('Approved Loans', function ($sheet) use ($all_loans) {
                    $sheet->fromArray($all_loans, null, 'A1', false, false);
                });

            })->download($type);
        }
    }

    public function export_pdf(Request $request)
    {
        $inputs = $request->all();

        return $this->to_pdf($inputs['function']);

    }

    private function to_pdf($function)
    {
        $l = new Loan;
        $log = new Log;
        $email = Session::get('admin');
        $role = 'admin';

        $date = date("l jS \of F Y h:i:s A");
//
        if ($function === "all_loans") {
            $loans = $l->get_all_loans();
            $pdf = PDF::loadView('PDF.all_loans', ['loans' => $loans, 'date' => $date, 'title' => 'All Loans']);

            $msg = $email . " exported all loans in the system as a pdf file.";
            $log->insert($msg, $email, $role);

            return $pdf->download('All Loans.pdf');
        }

        if ($function === "pending") {
            $loans = $l->get_all_pending_loans();
            $pdf = PDF::loadView('PDF.all_loans', ['loans' => $loans, 'date' => $date, 'title' => 'Pending Loans']);

            $msg = $email . " exported all pending loans in the system as a pdf file.";
            $log->insert($msg, $email, $role);

            return $pdf->download('Pending Loans.pdf');
        }

        if ($function === "approved") {
            $loans = $l->get_all_approved_loans();
            $pdf = PDF::loadView('PDF.all_loans', ['loans' => $loans, 'date' => $date, 'title' => 'Approved Loans']);

            $msg = $email . " exported all approved loans in the system as a pdf file.";
            $log->insert($msg, $email, $role);

            return $pdf->download('Approved Loans.pdf');
        }

        if ($function === "refused") {
            $loans = $l->get_all_refused_loans();
            $pdf = PDF::loadView('PDF.all_loans', ['loans' => $loans, 'date' => $date, 'title' => 'Refused Loans']);

            $msg = $email . " exported all refused loans in the system as a pdf file.";
            $log->insert($msg, $email, $role);

            return $pdf->download('Refused Loans.pdf');
        }
    }

    public function client_log()
    {
//        echo "sd";
        $log = new Log;
        $loan = new Loan;


        $pending1 = $loan->get_num_pending_loans();
        $approved = $loan->get_num_approved_loans();
        $refused = $loan->get_num_refused_loans();
        $all = $loan->get_num_loans();

        $data = $log->get_client_logs();

        return view('admin_views.clogs')
            ->with('clogs', $data)
            ->with('all', $all)
            ->with('approved', $approved)
            ->with('refused', $refused)
            ->with('pending', $pending1);
    }

    public function admin_log()
    {
        $log = new Log;
        $l = new Loan;
//
        $data = $log->get_admin_logs();

        $pending1 = $l->get_num_pending_loans();
        $approved = $l->get_num_approved_loans();
        $refused = $l->get_num_refused_loans();
        $all = $l->get_num_loans();

//        return $data;

        return view('admin_views.alogs')->with('alogs', $data)
            ->with('pending', $pending1)
            ->with('approved', $approved)
            ->with('refused', $refused)
            ->with('all', $all);
//            ->with('pending', $pending1);
    }

    public function manage_clients()
    {
        $u = new User;

        $users = $u->get_all_users();

        return view('admin_views.all-clients')->with('users', $users);
    }

    public function single_client_details(Request $request)
    {
        $c = new Client;
        $e = new Employer;
        $u = new User;
        $s = new Spouse;

        $inputs = $request->all();

        $clients = $c->get_clients($inputs['email']);
        $emps = $e->get_employer($inputs['email']);
        $users = $u->get_user($inputs['email']);
        $spouses = $s->get_spouse($inputs['email']);
//        return $users;
        return view('admin_views.single-client', [
            'pic'=>$users[0]->pic,
            'title' => $clients[0]->title,
            'gender' => $clients[0]->gender,
            'surname' => $users[0]->surname,
            'firstname' => $users[0]->firstname,
            'othernames' => $users[0]->othernames,
            'sname' => $spouses[0]->name,
            'saddress' => $spouses[0]->address,
            'stel' => $spouses[0]->number,
            'soccup' => $spouses[0]->spouse_occupation,
            'numchildren' => $clients[0]->num_children,
            'raddress' => $clients[0]->residential_address,
            'maddress' => $clients[0]->mailing_address,
            'telmob' => $clients[0]->telephone_mobile,
            'teloff' => $clients[0]->telephone_official,
            'dob' => $clients[0]->date_of_birth,
            'email' => $users[0]->email,
            'occup' => $clients[0]->occupation,
            'pos' => $clients[0]->position_held,
            'nation' => $clients[0]->nationality,
            'numyears' => $clients[0]->number_of_years,
            'empname' => $emps[0]->name,
            'empaddress' => $emps[0]->address,
            'mstatus' => $clients[0]->marital_status_id,
            'sof' => $clients[0]->source_of_funds_id,
            'mincome' => $clients[0]->monthly_income_id,
            'identification' => $clients[0]->identification_number,
            'idnum' => $clients[0]->id_number,
            'issuedate' => $clients[0]->date_of_issue,
            'expdate' => $clients[0]->expiry_date,
            'literacy' => $clients[0]->literacy_level_id,
            'hometown' => $clients[0]->hometown,
            'soc' => $clients[0]->social_security,
            'members' => $clients[0]->household_members,
            'numdep' => $clients[0]->num_dependants,
            'father' => $clients[0]->father,
            'mother' => $clients[0]->mother,
            'kname' => $clients[0]->kin_name,
            'kaddress' => $clients[0]->kin_address,
            'ktel' => $clients[0]->kin_telephone,
            'krel' => $clients[0]->kin_relationship
        ]);
    }

    public function logout()
    {
        $u = new User;

        $u->logout();

        return redirect('/admin');
    }

    private function mail($data, $email, $subject)
    {
            Mail::send('email_views.email', $data, function ($m) use ($email, $subject) {
                $m->from('info@jirehmfl.com.gh', 'Jireh Microfinance Ltd');
                $m->to($email);
                $m->subject($subject);
            });
    }
}
