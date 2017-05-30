<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class apicontroller extends Controller
{
    public function login($email, $password)
    {
        $u = new User();

        $response = $u->login($email, $password);

        if ($response == 1) {
            return Response::json(array(
                'code' => 1,
                'msg' => 'Login successful'
            ));
        } else {
            return Response::json(array(
                'code' => 0,
                'msg' => 'failed'
            ));
        }
    }
}
