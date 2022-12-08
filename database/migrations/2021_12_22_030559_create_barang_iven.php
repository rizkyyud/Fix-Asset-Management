<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBarangIven extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('barang_iven', function (Blueprint $table) {
            $table->increments('id_barangIven');
            $table->string('nama_barang');
            $table->integer('id_jenisIven')->unsigned();
            $table->string('kode_barang');
            $table->string('satuan');
            $table->integer('label');
            $table->timestamps();
        });

        // Schema::table('barang_iven', function (Blueprint $table) {
        //     $table->foreign('id_jenisIven')->references('id_jenisIven')->on('jenis_iventaris')->onDelete('cascade')->onUpdate('cascade');
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('barang_iven');
    }
}
