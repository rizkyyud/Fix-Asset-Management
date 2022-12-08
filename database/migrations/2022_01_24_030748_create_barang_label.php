<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBarangLabel extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('barang_label', function (Blueprint $table) {
            $table->string('kode_label')->primary();
            $table->integer('id_iventaris')->unsigned()->default(0);
            $table->integer('id_maintenance')->unsigned()->default(0);
            $table->integer('id_control')->unsigned()->default(0);
            $table->integer('id_repait')->unsigned()->default(0);
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
        Schema::dropIfExists('barang_label');
    }
}
