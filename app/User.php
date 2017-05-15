<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


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

    public function login($email, $password)
    {
        if (Auth::attempt(['email' => $email, 'password' => $password])) {
//            echo 'true';
            session()->put('email', $email);

            return 1;
        } else {
            return 0;
        }
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
//    protected $fillable = [
//        'surname', 'firstname', 'othernames','username','email','pic','last_logged_in','created_at','updated_at'
//    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
//    protected $hidden = [
//        'password', 'remember_token',
//    ];
}
