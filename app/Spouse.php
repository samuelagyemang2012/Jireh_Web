<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;

class Spouse extends Model
{
//    use D
    public function insert($cemail, $name, $address, $number)
    {

        DB::table('spouses')->insert(
            ['client_email' => $cemail,
                'name' => $name,
                'address' => $address,
                'number' => $number
            ]
        );
    }
}
