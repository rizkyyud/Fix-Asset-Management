<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('id_barang');
            $table->bigInteger('jumlah');
            $table->string('alasan');
            $table->bigInteger('harga')->default(0);
            $table->bigInteger('id_cart');
            $table->bigInteger('id_assets');
            $table->bigInteger('id_sub')->default(0);
            $table->string('status');
            $table->integer('cekData')->default(0);
            $table->string('note')->nullable();
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
        Schema::dropIfExists('orders');
    }
}
