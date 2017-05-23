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

    public function update_clients($email, $title, $gender, $num_children, $residential, $mailing_address, $telephone_mobile, $telephone_official, $dob, $occupation, $position_held, $nationality, $cur_num_years, $marital_status_id, $source_of_funds_id, $monthly_income_id, $identification_number_id, $id_number, $date_of_issue, $expirydate, $literacy_level_id, $hometown, $social_security, $household_members, $num_dependants, $father, $mother, $kin_name, $kin_address, $kin_telephone, $kin_relationship)
    {
        DB::table('clients')
            ->where('email', $email)
            ->update(['email' => $email,
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

    public function get_client_names($email)
    {
        return DB::table('users')
            ->where('email', '=', $email)
            ->select('firstname', 'surname', 'last_logged_in')
            ->get();
    }

    public function get_clients($email)
    {
        return DB::table('clients')
            ->select('clients.id',
                'clients.email',
                'clients.title',
                //'titles.name',
                'clients.gender',
                'clients.marital_status_id',
                //'marital_statuses.name',
                'clients.num_children',
                'clients.residential_address',
                'clients.mailing_address',
                'clients.telephone_mobile',
                'clients.telephone_official',
                'clients.date_of_birth',
                'clients.occupation',
                'clients.position_held',
                'clients.nationality',
                'clients.number_of_years',
                'clients.source_of_funds_id',
                //'source_of_funds.name',
                'clients.monthly_income_id',
                //'monthly_incomes.name',
                'clients.identification_number',
                'clients.id_number',
                'clients.date_of_issue',
                'clients.expiry_date',
                'clients.literacy_level_id',
                //'literacy_levels.name',
                'clients.hometown',
                'clients.social_security',
                'clients.household_members',
                'clients.num_dependants',
                'clients.father',
                'clients.mother',
                'clients.kin_name',
                'clients.kin_address',
                'clients.kin_telephone',
                'clients.kin_relationship',
                'clients.created_at')
//            ->join('titles', 'titles.id', '=', 'clients.title')
//            ->join('marital_statuses', 'marital_statuses.id', '=', 'clients.marital_status_id')
//            ->join('source_of_funds', 'source_of_funds.id', '=', 'clients.source_of_funds_id')
//            ->join('monthly_incomes', 'monthly_incomes.id', '=', 'clients.monthly_income_id')
//            ->join('literacy_levels', 'literacy_levels.id', '=', 'clients.literacy_level_id')
            ->where('clients.email', '=', $email)
            ->get();
//            ->paginate(10);
    }
}
