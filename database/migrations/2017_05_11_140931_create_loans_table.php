<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLoansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loans', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('client_id');
            $table->string('position_held');
            $table->double('net_monthly_income');
            $table->string('other_source');
            $table->string('bank_branch');
            $table->integer('num_cur_loans');
            $table->double('total_monthly_payments');
            $table->string('name_of_institution');
            $table->double('amount_requested');
            $table->integer('loan_period');
            $table->string('purpose_of_loan');
            $table->string('collateral_details');
            $table->integer('cash_collection_service');
            $table->string('witness_name');
            $table->string('witness_employer');
            $table->string('witness_tel');
            $table->timestamp('created_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(\DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
//            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('loans');
    }
}
