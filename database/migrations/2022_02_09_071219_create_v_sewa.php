<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVSewa extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('v_sewa', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('id_sewa')->unsigned();
            $table->bigInteger('id_vSewa')->unsigned()->default(0);
            $table->string('nama_vSewa')->unsigned()->default(0);
            $table->string('divisi_vSewa')->unsigned()->default(0);
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
        Schema::dropIfExists('v_sewa');
    }
}
