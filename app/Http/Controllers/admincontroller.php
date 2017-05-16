<?php

namespace App\Http\Controllers;

use App\Client;
use App\Loan;
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
        $pending = $l->get_client_pending_loans();

        return view('admin_views.index')->with('pending', $pending);

    }

    public function pending()
    {
        $l = new Loan;
        $pending = $l->get_client_pending_loans();

        return view('admin_views.pending')
            ->with('pending', $pending);
    }

    public function client_details(Request $request)
    {
        $c = new Client;

        $input = $request->all();
        $input['email'];
        $data = $c->get_client_details($input['email'], $input['id']);

//        echo $data[0]->surname;

        return view('admin_views.client')->with('data', $data[0]);

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
}
