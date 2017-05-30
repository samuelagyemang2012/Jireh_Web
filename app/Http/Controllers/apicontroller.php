<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class apicontroller extends Controller
{
    public function login($email, $password)
    {
        $u = new User();

        return "da";
    }
}
