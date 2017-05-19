<?php

namespace App\Http\Controllers;

use App\Admin;
use App\Client;
use App\Loan;
use App\title;
use App\User;
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
        $c = new Client;
        $l = new Loan;

//        $allclients = $c->get_num_clients();
//        $allloans = $l->get_num_loans();
        $pending = $l->get_all_pending_loans();

        return view('admin_views.index')->with('pending', $pending)->with('title', 'Home');
    }

    public function pending()
    {
        $l = new Loan;
        $pending = $l->get_all_pending_loans();

        return view('admin_views.pending')
            ->with('title', 'Pending Loans')
            ->with('pending', $pending);
    }

    public function approved()
    {
        $l = new Loan;

        $aploans = $l->get_all_approved_loans();

//        return $aploans;
        return view('admin_views.approved')
            ->with('title', 'Approved Loans')
            ->with('aploans', $aploans);

    }

    public function refused()
    {
        $l = new Loan;

        $rloans = $l->get_all_refused_loans();

//        return $aploans;
        return view('admin_views.refused')
            ->with('title', 'Approved Loans')
            ->with('rloans', $rloans);
    }

    public function all()
    {
        $l = new Loan;

        $all = $l->get_all_loans();

        return view('admin_views.all-loans')
            ->with('title', 'All Loans')
            ->with('all', $all);
    }

    public function client_details(Request $request)
    {
        $c = new Client;

        $input = $request->all();
//        $input['email'];
        $data = $c->get_client_details($input['email'], $input['id']);

//        echo $data[0]->surname;

        return view('admin_views.client')->with('data', $data[0])->with('title', 'Client Details');

    }

    public function approve_loan(Request $request)
    {
        $l = new Loan;

        $input = $request->all();

        $l->approve_loan($input['id']);

//        Mail::send(['text'=>'email_views.email'], function ($message) {
//            $message->from('khermztest@gmail.com', 'Khermz2012');
//            $message->to('khermz2012@gmail.com');
//        });

        return redirect('/admin/dashboard');
    }

    public function refuse_loan(Request $request)
    {
        $l = new Loan;

        $input = $request->all();

        $l->refuse_loan($input['id']);

        return redirect('/admin/dashboard');
    }

    public function store(Request $request)
    {
        $user = new User;

        $input = $request->all();

        $res = $user->admin_login($input['email'], $input['password']);

        $role = Session::get('role');

        if ($res == 1 && $role === 'admin') {

            return redirect('admin\dashboard');

        } else {
            echo 'false';
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

        $npass = bcrypt($inputs['password']);

        $a->add_admin($inputs['surname'], $inputs['firstname'], $npass, $inputs['email'], 'admin');

//        $surname, $firstname, $password, $email, $role

        return redirect('/admin/dashboard')->with('New Admin Created successfully');
    }

    public function edit_admin(Request $request)
    {
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

        return redirect('/admin/dashboard')->with('status', 'Credentials Updated successfully');
    }

    /**
     * @param $loans
     * @return array
     */
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

    /**
     * @param $function
     * @param $type
     */
    private function to_excel($function, $type)
    {
        $l = new Loan;

        if ($function === "all_loans") {

            $all_loans = $l->get_all_loans();

            $all_loans = $this->loans_to_Array($all_loans);

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

//        return $request->all();

        return $this->to_pdf($inputs['function']);

    }

    private function to_pdf($function)
    {
        $l = new Loan;

        $date = date("l jS \of F Y h:i:s A");
//
        if ($function === "all_loans") {
            $loans = $l->get_all_loans();
            $pdf = PDF::loadView('PDF.all_loans', ['loans' => $loans, 'date' => $date, 'title'=>'All Loans']);
            return $pdf->download('All Loans.pdf');
        }

        if ($function === "pending") {
            $loans = $l->get_all_pending_loans();
            $pdf = PDF::loadView('PDF.all_loans', ['loans' => $loans, 'date' => $date, 'title'=>'Pending Loans']);
            return $pdf->download('Pending Loans.pdf');
        }

        if ($function === "approved") {
            $loans = $l->get_all_approved_loans();
            $pdf = PDF::loadView('PDF.all_loans', ['loans' => $loans, 'date' => $date, 'title'=>'Approved Loans']);
            return $pdf->download('Approved Loans.pdf');
        }

        if ($function === "refused") {
            $loans = $l->get_all_refused_loans();
            $pdf = PDF::loadView('PDF.all_loans', ['loans' => $loans, 'date' => $date, 'title'=>'Refused Loans']);
            return $pdf->download('Refused Loans.pdf');
        }
    }
}
