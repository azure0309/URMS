<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TSimInfoInboundBackup extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_invoice_sim_info_inbound_backup', function (Blueprint $table) {
            $table->increments('id');
            $table->string('tadig');
            $table->string('operator')->nullable();
            $table->string('country')->nullable();
            $table->string('agreement')->nullable();
            $table->string('msisdn')->nullable();
            $table->string('imsi')->nullable();
            $table->string('icc_id')->nullable();
            $table->string('pin_1')->nullable();
            $table->string('puk_1')->nullable();
            $table->string('type')->nullable();
            $table->string('post_pps')->nullable();
            $table->string('card_status')->nullable();
            $table->string('card_location')->nullable();
            $table->date('dt')->nullable();
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
