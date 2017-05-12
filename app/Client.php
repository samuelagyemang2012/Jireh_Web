<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;

class Client extends Model
{
    public function insert($email, $title, $num_children, $residential, $mailing_address, $telephone_mobile, $telephone_official, $dob, $occupation, $nationality, $marital_status_id, $source_of_funds_id, $monthly_income_id, $identification_number, $id_number, $date_of_issue, $expirydate, $literacy_level_id, $hometown, $social_security, $household_members, $num_dependants, $father, $mother, $kin_name, $kin_address, $kin_telephone, $kin_relationship)
    {
        DB::table('clients')->insert(
            ['email' => $email,
                'title' => $title,
                'num_children' => $num_children,
                'residential' => $residential,
                'mailing_address' => $mailing_address,
                'telephone_mobile' => $telephone_mobile,
                'telephone_official' => $telephone_official,
                'date_of_birth' => $dob,
                'occupation' => $occupation,
                'nationality' => $nationality,
                'marital_status_id' => $marital_status_id,
                'source_of_funds' => $source_of_funds_id,
                'monthly_income_id' => $monthly_income_id,
                'identification_number' => $monthly_income_id,
                'id_number' => $id_number,
                'date_of_issue' => $date_of_issue,
                'expirydate' => $expirydate,
                'literacy_level_id' => $literacy_level_id,
                'hometown' => $hometown,
                'social_security' => $social_security,
                'household_members' => $household_members,
                'num_dependants' => $num_dependants,
                'father' => $father,
                'mother' => $mother,
                'kin_name' => $kin_name,
                'kin_address' => $kin_address,
                'kin_telephone' => $kin_telephone,
                'kin_relationship' => $kin_relationship
            ]);
    }
//        [
//        
//    ];

//    protected $hidden = [
//        other_source, other_status, other_identification, other_literacy
//    ];
}
