<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePesanan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pesanan', function (Blueprint $table) {
            $table->bigIncrements('id_orders');
            $table->integer('id_barangIven')->unsigned();
            $table->integer('id_vendor')->unsigned();
            $table->integer('id_validator')->unsigned();
            $table->bigInteger('id_cart')->unsigned();
            $table->bigInteger('id_checker')->unsigned();
            $table->string('kode_order');
            $table->string('model')->nullable();
            $table->string('merk')->nullable();
            $table->string('warna')->nullable();
            $table->string('ukuran')->nullable();
            $table->integer('jlh_barang');
            $table->text('alasan_beli');
            $table->text('foto')->nullable();
            $table->bigInteger('harga')->default(0);
            $table->string('status')->default('Request');
            $table->string('keterangan')->nullable();
            $table->timestamps();
        });

        // Schema::table('pesanan', function (Blueprint $table) {
        //     $table->foreign('id_barangIven')->references('id_barangIven')->on('barang_iven')->onDelete('cascade')->onUpdate('cascade');
        //     $table->foreign('id_vendor')->references('id_vendor')->on('vendors')->onDelete('cascade')->onUpdate('cascade');
        //     $table->foreign('id_validator')->references('id_validator')->on('validation')->onDelete('cascade')->onUpdate('cascade');
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pesanan');
    }
}
