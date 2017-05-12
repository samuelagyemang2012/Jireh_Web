<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class loan extends Model
{
    protected $fillable = [
        'user_id', 'client_id', 'position_held', 'other_source', 'bank_branch', 'num_cur_loans', 'total_monthly_payments', 'name_of_institution', 'amount_requested', 'loan_period', 'purpose_of_loans', 'collateral_details', 'cash_collection_service', 'witness_name', 'witness_employer', 'witness_tel', 'created_at', 'updated_at'
    ];
}
