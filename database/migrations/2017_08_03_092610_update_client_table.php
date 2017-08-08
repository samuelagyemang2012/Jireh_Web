<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateClientTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('clients', function (Blueprint $table) {

            $table->string('telephone_official')->nullable();
            $table->integer('number_of_years')->nullable();
            $table->string('social_security')->nullable();
            $table->integer('household_members')->nullable();
            $table->string('father')->nullable();
            $table->string('mother')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
