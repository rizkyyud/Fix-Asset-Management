<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSewaFasilitas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sewa_fasilitas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('id_gedung')->unsigned();
            $table->bigInteger('id_barang')->unsigned();
            $table->bigInteger('jumlah')->unsigned();
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
        Schema::dropIfExists('sewa_fasilitas');
    }
}
