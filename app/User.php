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
        $api = uniqid();

        DB::table('users')->insert(
            ['surname' => $surname,
                'firstname' => $firstname,
                'othernames' => $othernames,
                'password' => $password,
                'email' => $email,
                'pic' => $pic,
                'last_logged_in' => $last,
                'role' => 'user',
//                'api_token' => $api
            ]);
    }

    public function update_user($email, $surname, $firstname, $othernames)
    {
        DB::table('users')
            ->where('email', '=', $email)
            ->update([
                'surname' => $surname,
                'firstname' => $firstname,
                'othernames' => $othernames,
            ]);
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

//            return Auth::user();

            session()->put('email', $email);
            session()->put('logged_in', 'true');

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

            $data = Auth::user();

            $email = $data['email'];
            $role = $data['role'];

            session()->put('aemail', $email);

            session()->put('role', $role);

            return 1;
//            return $data;
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
            ->get();
    }

    public function get_uniques($email, $soc)
    {
        return DB::table('clients')
            ->where('email', '=', $email)
            ->orWhere('social_security', '=', $soc)
//            ->select('clients.email','clients.social_security')
            ->count();
//            ->get();
    }
}
