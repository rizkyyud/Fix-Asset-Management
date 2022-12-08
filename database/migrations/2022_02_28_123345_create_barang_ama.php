<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBarangAma extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('barang_ama', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('id_kategori');
            $table->bigInteger('id_jenis');
            $table->integer('id_model');
            $table->integer('id_merk');
            $table->integer('id_warna');
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
        Schema::dropIfExists('barang_ama');
    }
}
