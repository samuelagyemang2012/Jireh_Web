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

    public function get_client_pending_loan_details($email)
    {
        return DB::table('loans')
            ->join('statuss', 'loans.status_id', '=', 'statuss.id')
            ->select('loans.purpose_of_loan', 'loans.date_applied', 'loans.amount_requested', 'statuss.name')
            ->where('loans.client_email', '=', $email)
            ->where('loans.status_id', '=', '1')
            ->orderBy('created_at','desc')
            ->get();
    }

    public function get_client_approved_loan_details($email)
    {
        return DB::table('loans')
            ->join('statuss', 'loans.status_id', '=', 'statuss.id')
            ->select('loans.purpose_of_loan', 'loans.date_applied', 'loans.amount_requested', 'statuss.name')
            ->where('loans.client_email', '=', $email)
            ->where('loans.status_id', '=', '2')
            ->orderBy('created_at','desc')
            ->get();
    }

    public function get_client_refused_loan_details($email)
    {
        return DB::table('loans')
            ->join('statuss', 'loans.status_id', '=', 'statuss.id')
            ->select('loans.purpose_of_loan', 'loans.date_applied', 'loans.amount_requested', 'statuss.name')
            ->where('loans.client_email', '=', $email)
            ->where('loans.status_id', '=', '3')
            ->orderBy('created_at','desc')
            ->get();
    }

    public function get_client_all_loans($email)
    {

        return DB::table('loans')
            ->join('statuss', 'loans.status_id', '=', 'statuss.id')
            ->select('loans.amount_requested', 'statuss.name')
            ->where('loans.client_email', '=', $email)
            ->get();
    }

    public function get_all_loans()
    {
        return DB::table('loans')
            ->join('users', 'users.email', '=', 'loans.client_email')
            ->join('clients', 'users.email', '=', 'clients.email')
            ->select('users.firstname', 'users.surname', 'users.email', 'clients.telephone_mobile', 'loans.id', 'loans.date_applied', 'loans.amount_requested')
            ->orderBy('loans.amount_requested', 'asc')
            ->get();
    }

    public function get_all_pending_loans()
    {
        return DB::table('loans')
            ->join('users', 'users.email', '=', 'loans.client_email')
            ->join('clients', 'users.email', '=', 'clients.email')
            ->select('users.firstname', 'users.surname', 'users.email', 'clients.telephone_mobile', 'loans.id', 'loans.date_applied', 'loans.amount_requested')
            ->where('loans.status_id', '=', '1')
            ->get();
    }

    public function get_all_approved_loans()
    {
        return DB::table('loans')
            ->join('users', 'users.email', '=', 'loans.client_email')
            ->join('clients', 'users.email', '=', 'clients.email')
            ->select('users.firstname', 'users.surname', 'users.email', 'clients.telephone_mobile', 'loans.id', 'loans.date_applied', 'loans.amount_requested')
            ->where('loans.status_id', '=', '2')
            ->get();
    }

    public function get_all_refused_loans()
    {
        return DB::table('loans')
            ->join('users', 'users.email', '=', 'loans.client_email')
            ->join('clients', 'users.email', '=', 'clients.email')
            ->select('users.firstname', 'users.surname', 'users.email', 'clients.telephone_mobile', 'loans.id', 'loans.date_applied', 'loans.amount_requested')
            ->where('loans.status_id', '=', '3')
            ->get();
    }

    public function get_num_loans()
    {
        return DB::table('loans')->count();
    }

    public function get_num_pending_loans()
    {
        return DB::table('loans')
            ->where('status_id', '=', '1')
            ->count();
    }

    public function get_num_approved_loans()
    {
        return DB::table('loans')
            ->where('status_id', '=', '2')
            ->count();
    }

    public function get_num_refused_loans()
    {
        return DB::table('loans')
            ->where('status_id', '=', '3')
            ->count();
    }

    public function get_num_client_pending_loans($email)
    {
        return DB::table('loans')->where('client_email', '=', $email)->where('status_id', '=', 1)->count();
    }

    public function get_num_all_client_loans($email)
    {
        return DB::table('loans')
            ->where('client_email', '=', $email)
            ->count();
    }

    public function get_num_approved_client_loans($email)
    {
        return DB::table('loans')->where('client_email', '=', $email)->where('status_id', '=', 2)->count();
    }

    public function get_num_refused_client_loans($email)
    {
        return DB::table('loans')->where('client_email', '=', $email)->where('status_id', '=', 3)->count();
    }

    public function approve_loan($id)
    {
        DB::table('loans')
            ->where('id', $id)
            ->update(['status_id' => 2]);
    }

    public function refuse_loan($id)
    {
        DB::table('loans')
            ->where('id', $id)
            ->update(['status_id' => 3]);
    }

    public function get_loan_details_by_id($id)
    {
        return DB::table('loans')
            ->where('id', '=', $id)
            ->select('loans.client_email', 'loans.amount_requested', 'loans.created_at')
            ->get();
    }

}