<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenyewaansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penyewaans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nomor_resi');
            $table->date('checkIn');
            $table->date('checkOut');
            $table->bigInteger('id_asset');
            $table->bigInteger('id_penyewa');
            $table->bigInteger('id_sub')->nullable();
            $table->bigInteger('id_season')->nullable();
            $table->bigInteger('harga');
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
        Schema::dropIfExists('penyewaans');
    }
}
