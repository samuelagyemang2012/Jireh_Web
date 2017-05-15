<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->increments('id');
            $table->string('email')->unique();
            $table->integer('title');
            $table->string('gender');
            $table->integer('num_children');
            $table->string('residential_address');
            $table->string('mailing_address');
            $table->string('telephone_mobile');
            $table->string('telephone_official');
            $table->date('date_of_birth');
            $table->string('occupation');
            $table->string('position_held');
            $table->string('nationality');
            $table->integer('number_of_years');
            $table->integer('marital_status_id');
            $table->integer('source_of_funds_id');
            $table->integer('monthly_income_id');
            $table->integer('identification_number');
            $table->string('id_number');
            $table->string('date_of_issue');
            $table->string('expiry_date');
            $table->integer('literacy_level_id');
            $table->string('hometown');
            $table->string('social_security');
            $table->integer('household_members');
            $table->integer('num_dependants');
            $table->string('father');
            $table->string('mother');
            $table->string('kin_name');
            $table->string('kin_address');
            $table->string('kin_telephone');
            $table->string('kin_relationship');
            $table->string('other_source')->nullable();
            $table->string('other_status')->nullable();
            $table->string('other_identification')->nullable();
            $table->string('other_literacy')->nullable();
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
        Schema::dropIfExists('clients');
    }
}
