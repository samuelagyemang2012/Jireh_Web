<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;


class apicontroller extends Controller
{
    public function login($email, $password)
    {

        $email = $_POST['email'];
        $password = $_POST['password'];

        return $email;
    }


}

