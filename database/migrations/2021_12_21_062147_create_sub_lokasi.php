<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubLokasi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sub_lokasi', function (Blueprint $table) {
            $table->increments('id_subL');
            $table->string('nama_subL');
            $table->integer('id_lokasi')->unsigned();
            $table->timestamps();
        });

        // Schema::table('sub_lokasi', function (Blueprint $table) {
        //     $table->foreign('id_lokasi')->references('id_lokasi')->on('lokasi')->onDelete('cascade')->onUpdate('cascade');
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sub_lokasi');
    }
}
