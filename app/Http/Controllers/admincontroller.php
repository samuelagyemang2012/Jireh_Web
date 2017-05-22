<?php

namespace App\Http\Controllers;

use App\Admin;
use App\Client;
use App\Loan;
use App\title;
use App\User;
use App\Log;
use Dompdf\Adapter\PDFLib;
use Illuminate\Http\Request;
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
//        echo "home";
        $c = new Client;
        $l = new Loan;

        $pending = $l->get_all_pending_loans();
        $pending1 = $l->get_num_pending_loans();
        $approved = $l->get_num_approved_loans();
        $refused = $l->get_num_refused_loans();
        $all = $l->get_num_loans();

        return view('admin_views.pending')
            ->with('pending', $pending)
            ->with('pending1', $pending1)
            ->with('approved', $approved)
            ->with('refused', $refused)
            ->with('all', $all);

    }

    public function pending()
    {
        $l = new Loan;

        $pending1 = $l->get_num_pending_loans();
        $approved = $l->get_num_approved_loans();
        $refused = $l->get_num_refused_loans();
        $all = $l->get_num_loans();

        $pending = $l->get_all_pending_loans();

        return view('admin_views.pending')
            ->with('title', 'Pending Loans')
            ->with('pendingl', $pending)
            ->with('pending', $pending1)
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

        $input = $request->all();

        $l->approve_loan($input['id']);

        $email = Session::get('admin');

        $client = $l->get_loan_email_by_id(($input['id']));

        $msg = $email . " approved a loan by" . $client[0]->client_email;
//
        $log->insert($msg, $email, 'admin');

//        Mail::send(['text'=>'email_views.email'], function ($message) {
//            $message->from('khermztest@gmail.com', 'Khermz2012');
//            $message->to('khermz2012@gmail.com');
//        });

        return redirect('/admin/dashboard');
    }

    public function refuse_loan(Request $request)
    {
        $l = new Loan;
        $log = new Log;

        $input = $request->all();

        $l->refuse_loan($input['id']);

        $email = Session::get('admin');

        $client = $l->get_loan_email_by_id($input['id']);

        $msg = $email . " refused a loan by" . $client[0]->client_email;
        $log->insert($msg, $email, 'admin');

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

    public function edit_admin(Request $request)
    {
        $log = new Log;
        $email = Session::get('email');
        $role = "admin";

        $inputs = $request->all();

        $sesion_email = Session::get('aemail');
        session()->forget('aemail');

        $rules = [
            'email' => 'required|min:6|unique:users',
            'password' => 'required|min:6',
            'confirm_password' => 'required|same:password'
        ];

        $this->validate($request, $rules);

        $a = new Admin;

        $npass = bcrypt($inputs['password']);

        $a->update_admin_details($sesion_email, $inputs['email'], $npass);

        session()->put('aemail', $inputs['email']);

        $msg = $email . " updated his email from " . $email . " to " . $inputs['email'];
        $log->insert($msg, $email, $role);

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

    public function mail()
    {
//        echo 'mail';
        $data = array('name' => "Virat Gandhi");

        Mail::send(['text' => 'email_views.email'], $data, function ($message) {
            $message->to('khermz2012@gmail.com', 'Tutorials Point')->subject
            ('Laravel Basic Testing Mail');
            $message->from('xyz@gmail.com', 'Virat Gandhi');
        });

        echo 'sent';
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

}
