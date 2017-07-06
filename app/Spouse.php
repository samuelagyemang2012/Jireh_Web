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

    public function update_spouse($cemail, $name, $address, $number)
    {
        DB::table('spouses')
            ->where('client_email', '=', $cemail)
            ->update([
                'name' => $name,
                'address' => $address,
                'number' => $number
            ]);
    }

    public function get_spouse($email)
    {
        return DB::table('spouses')
            ->where('spouses.client_email', '=', $email)
            ->get();
    }
}
