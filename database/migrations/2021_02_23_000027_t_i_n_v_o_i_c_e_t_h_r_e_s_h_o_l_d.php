<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TINVOICETHRESHOLD extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_invoice_threshold', function (Blueprint $table) {
            $table->increments('id');
            $table->string('cust_urag');
            $table->string('cust_name');
            $table->string('prod_cd');
            $table->integer('ncmv');
            $table->string('currency');
            $table->string('note');
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
