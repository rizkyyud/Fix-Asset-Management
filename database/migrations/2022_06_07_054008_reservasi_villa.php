<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ReservasiVilla extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('reservasi_villa', function (Blueprint $table) {
            $table->string('kode_reservasi', 255)->primary();
            $table->bigInteger('id_penyewa');
            $table->integer('id_villa');
            $table->date('check_in');
            $table->date('check_out');
            $table->bigInteger('diskon');
            $table->bigInteger('tagihan');
            $table->string('status');
            $table->bigInteger('first_pay');
            $table->bigInteger('lunas');
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
        Schema::dropIfExists('reservasi_villa');
    }
}
