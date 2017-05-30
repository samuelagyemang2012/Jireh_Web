<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;


class apicontroller extends Controller
{
    public function login(Request $request)
    {
        $u = new User;

        $input = $request->all();

        return $input;

//        $response = $u->login($email, $password);
//
////        Auth::guard('api')->user();
//
//        if ($response == 1) {
//
//            $token = str_random(60);
//
//            return response()->json([
//                'code' => 1,
//                'msg' => "Login Successful",
//                'token' => $token
//            ]);
//
//        } else {
//
//            return response()->json([
//                'code' => 0,
//                'msg' => "Login Successful",
//                'token' => null
//            ]);
//        }
    }
}

