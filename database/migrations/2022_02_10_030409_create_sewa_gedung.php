<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSewaGedung extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sewa_gedung', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('id_sewa')->unsigned();
            $table->date('tanggal');
            $table->time('mulai');
            $table->time('selesai');
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
        Schema::dropIfExists('sewa_gedung');
    }
}
