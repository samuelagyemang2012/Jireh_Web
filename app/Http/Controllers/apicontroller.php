<?php

namespace App\Http\Controllers;

use App\User;


class apicontroller extends Controller
{
    public function login($username, $password)
    {
        $u = new User;

        $response = $u->login($username, $password);

        if ($response == 1) {

            $token = str_random(60);

            return response()->json([
                'code' => 1,
                'msg' => "Login Successful",
                'token' => $token
            ]);

        } else {

            return response()->json([
                'code' => 0,
                'msg' => "Login Successful",
                'token' => null
            ]);
        }
    }
}

