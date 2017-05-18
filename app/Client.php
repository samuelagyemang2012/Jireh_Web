<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;

class Client extends Model
{
    public function insert($email, $title, $gender, $num_children, $residential, $mailing_address, $telephone_mobile, $telephone_official, $dob, $occupation, $position_held, $nationality, $cur_num_years, $marital_status_id, $source_of_funds_id, $monthly_income_id, $identification_number_id, $id_number, $date_of_issue, $expirydate, $literacy_level_id, $hometown, $social_security, $household_members, $num_dependants, $father, $mother, $kin_name, $kin_address, $kin_telephone, $kin_relationship)
    {
        DB::table('clients')->insert(
            ['email' => $email,
                'title' => $title,
                'gender' => $gender,
                'num_children' => $num_children,
                'residential_address' => $residential,
                'mailing_address' => $mailing_address,
                'telephone_mobile' => $telephone_mobile,
                'telephone_official' => $telephone_official,
                'date_of_birth' => $dob,
                'occupation' => $occupation,
                'position_held' => $position_held,
                'nationality' => $nationality,
                'number_of_years' => $cur_num_years,
                'marital_status_id' => $marital_status_id,
                'source_of_funds_id' => $source_of_funds_id,
                'monthly_income_id' => $monthly_income_id,
                'identification_number' => $identification_number_id,
                'id_number' => $id_number,
                'date_of_issue' => $date_of_issue,
                'expiry_date' => $expirydate,
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

    public function get_num_clients()
    {
        return DB::table('clients')->count();
    }

    public function get_client_details($email, $id)
    {
        return DB::table('clients')
            ->join('users', 'users.email', '=', 'clients.email')
            ->join('loans', 'loans.client_email', '=', 'clients.email')
            ->where('clients.email', '=', $email)
            ->where('loans.id', '=', $id)
            ->get();
    }
}
