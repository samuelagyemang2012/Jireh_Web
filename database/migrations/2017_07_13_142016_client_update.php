<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ClientUpdate extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
//        Schema::table('clients',function(Blueprint $table){
//            $table->integer('num_children')->nullable();
//        });

        DB::statement('ALTER TABLE `clients` MODIFY `num_children` INTEGER NULL;');
    }

    /**
     * Reverse the migrations.
     *ckear
     * @return void
     */
    public function down()
    {

    }
}
