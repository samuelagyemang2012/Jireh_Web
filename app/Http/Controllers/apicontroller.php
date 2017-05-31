<?php

//header('Access-Control-Allow-Origin: *');


namespace App\Http\Controllers;

use App\Client;
use App\User;
use Illuminate\Http\Request;

class apicontroller extends Controller
{
    public function login($email, $password)
    {
        $u = new User();

        $response = $u->login($email, $password);

        if ($response == 1) {

            return response()->json([
                "code" => 1
            ]);

        } else {

            return response()->json([
                "code" => 0
            ]);

        }
    }

    public function sign_up(Request $request)
    {
//        $c = new Client;
//
//        $c->insert();
        $input = $request->all();
        return $input;

    }

//    public function
}
