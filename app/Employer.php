<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;

class Employer extends Model
{
    public function insert($cemail, $name, $address)
    {
        DB::table('employers')->insert(
            ['client_email' => $cemail,
                'name' => $name,
                'address' => $address,
            ]
        );
    }

    public function get_employer($email)
    {
        return DB::table('employers')
            ->where('client_email', '=', $email)
            ->get();
    }
}
