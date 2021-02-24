<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Tinvoicepartnerinfo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_invoice_partner_info', function (Blueprint $table) {
            $table->increments('id');
            $table->string('country');
            $table->string('partner_name');
            $table->string('address');
            $table->string('phone');
            $table->string('email');
            $table->string('pmn_code');
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
