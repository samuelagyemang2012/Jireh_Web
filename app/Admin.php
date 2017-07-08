<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

//use Maatwebsite\Excel\Facades\Excel;

class Admin extends Model
{
//    public function login($email, $password)
//    {
//        if (Auth::attempt(['email' => $email, 'password' => $password])) {
//
//            session()->put('email', $email);
//            $role = $this->get_role($email);
//            session()->put('role', $role);
//
//            return 1;
//        } else {
//            return 0;
//        }
//    }
//
    public function add_admin($surname, $firstname, $password, $email, $role)
    {
        $date = date("l jS \of F Y h:i:s A");
        $api = uniqid();

        DB::table('users')
            ->insert(['surname' => $surname,
                    'firstname' => $firstname,
                    'email' => $email,
                    'pic' => '',
                    'last_logged_in' => $date,
                    'password' => $password,
                    'role' => 'admin',
                    'apitoken' => $api
                ]
            );
    }

    public function update_admin_details($old_email, $new_email, $password)
    {
        DB::table('users')
            ->where('email', $old_email)
            ->update(['password' => $password, 'email' => $new_email]);
    }

    public function all_loans_excel()
    {
        return "excel";
    }
}
