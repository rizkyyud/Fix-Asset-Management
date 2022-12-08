<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AssetsT extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('assets_t', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('kode_transport');
            $table->integer('jns_transports');
            $table->integer('nama_supir');
            $table->integer('model');
            $table->integer('merk');
            $table->integer('warna');
            $table->string('nomor_plat')->nullable();
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
        Schema::dropIfExists('assets_t');
    }
}
