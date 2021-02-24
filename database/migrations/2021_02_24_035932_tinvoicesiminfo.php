<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Tinvoicesiminfo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_invoice_sim_info', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('prod_no');
            $table->string('bill_acnt_num');
            $table->string('custrnm_num');
            $table->string('name');
            $table->string('country');
            $table->string('prod_name');
            $table->string('status');
            $table->string('acnt_blnc');
            $table->string('svc_type');
            $table->string('type');
            $table->timestamps();
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
