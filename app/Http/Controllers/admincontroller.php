<?php

namespace App\Http\Controllers;

use App\Admin;
use App\Client;
use App\Loan;
use App\title;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

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

        $a->add_admin($inputs['surname'], $inputs['firstname'], $inputs['email'], $npass, 'admin');

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
}
