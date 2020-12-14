<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TInvoiceClosePayment extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_invoice_close_payment', function (Blueprint $table) {
            $table->increments('id');
            $table->string('country');
            $table->string('operator');
            $table->integer('msisdn');
            $table->integer('total');
            $table->string('bill_month');
            $table->string('currency');
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
