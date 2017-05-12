<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Client extends Model
{
    protected $fillable = [
        'email', 'title', 'num_children', 'residential', 'mailing_address', 'telephone_mobile', 'telephone_official', 'nationality', 'marital_status_id', 'source_of_funds_id', 'monthly_income_id', 'identification_number', 'id_number', 'date_of_issue', 'expirydate', 'literacy_level_id', 'hometown', 'social_security', 'household_members', 'num_dependants', 'father', 'mother', 'kin_name', 'kin_address', 'kin_telephone', 'kin_relationship', 'created_at', 'updated_at'
    ];

    protected $hidden = [
        'other_source', 'other_status', 'other_identification', 'other_literacy'
    ];
}
