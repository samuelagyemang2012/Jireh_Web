<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;


class User extends Authenticatable
{
    use Notifiable;


    public function insert($surname, $firstname, $othernames, $password, $email, $pic, $last)
    {

        DB::table('users')->insert(
            ['surname' => $surname,
                'firstname' => $firstname,
                'othernames' => $othernames,
                'password' => $password,
                'email' => $email,
                'pic' => $pic,
                'last_logged_in' => $last
            ]
        );
    }

    private function get_role($email)
    {
        return DB::table('users')
            ->select('role')
            ->where('email', '=', $email)
            ->get();

    }

    public function login($email, $password)
    {
        if (Auth::attempt(['email' => $email, 'password' => $password])) {
//            echo 'true';
            session()->put('email', $email);

            $role = $this->get_role($email);

            $nrole = $role[0]->role;

            session()->put('urole', $nrole);

            return 1;
        } else {
            return 0;
        }
    }

    public function admin_login($email, $password)
    {
        if (Auth::attempt(['email' => $email, 'password' => $password])) {

            session()->put('aemail', $email);
//
            $role = $this->get_role($email);

            $nrole = $role[0]->role;

            session()->put('role', $nrole);
//
            return 1;
        } else {
            return 0;
        }
    }

    public function update_last_login($email, $date)
    {
        DB::table('users')
            ->where('email', $email)
            ->update(['last_logged_in' => $date]);
    }

    public function get_user($email)
    {
        return DB::table('users')
//            ->select('firstname','surname','othernames')
            ->where('email', '=', $email)
            ->get();
    }

    public function get_all_users()
    {
        return DB::table('users')
            ->where('role', '=', 'user')
            ->paginate(10);
    }

    public function logout()
    {
        Auth::logout();

    }

    public function get_uniques($email, $soc)
    {
        return DB::table('clients')->count()
            ->where('email', '=', $email)
            ->where('social_security', '=', $soc)
            ->select('clients.email','clients.social_security');
//            ->get();
    }
}
