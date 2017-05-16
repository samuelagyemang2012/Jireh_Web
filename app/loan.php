<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;


class Loan extends Model
{
    public function insert($email, $net_salary, $other_source, $bank, $salary_date, $cur_loans, $monthly_payments, $insti, $amount, $loan_period, $purpose, $col, $cash, $wname, $wemp, $wtel, $date, $status)
    {

        DB::table('loans')->insert(
            ['client_email' => $email,
                'net_monthly_salary' => $net_salary,
                'other_source' => $other_source,
                'bank_branch' => $bank,
                'salary_date' => $salary_date,
                'num_cur_loans' => $cur_loans,
                'total_monthly_payments' => $monthly_payments,
                'name_of_insti' => $insti,
                'amount_requested' => $amount,
                'loan_period' => $loan_period,
                'purpose_of_loan' => $purpose,
                'collateral_details' => $col,
                'cash_collection_service' => $cash,
                'witness_name' => $wname,
                'witness_employer' => $wemp,
                'witness_tel' => $wtel,
                'date_applied' => $date,
                'status_id' => $status
            ]
        );
    }

    public function get_loan_details($email)
    {
        return DB::table('loans')
            ->join('statuss', 'loans.status_id', '=', 'statuss.id')
            ->select('loans.purpose_of_loan', 'loans.date_applied', 'loans.amount_requested', 'statuss.name')
            ->where('loans.client_email', '=', $email)
            ->get();
    }

    public function get_client_pending_loans()
    {
        return DB::table('loans')
            ->join('users', 'users.email', '=', 'loans.client_email')
            ->join('clients', 'users.email', '=', 'clients.email')
            ->select('users.firstname', 'users.surname', 'users.email', 'clients.telephone_mobile', 'loans.id', 'loans.date_applied', 'loans.amount_requested')
            ->get();
    }

    public function get_num_loans()
    {
        return DB::table('loans')->count();
    }

    public function get_pending_loans($email)
    {
        return DB::table('loans')->where('client_email', '=', $email)->where('status_id', '=', 1)->count();
    }

    public function get_all_pending_loans()
    {
        return DB::table('loans')->count();
    }

    public function get_approved_loans($email)
    {
        return DB::table('loans')->where('client_email', '=', $email)->where('status_id', '=', 2)->count();
    }

    public function get_refused_loans($email)
    {
        return DB::table('loans')->where('client_email', '=', $email)->where('status_id', '=', 3)->count();
    }
}