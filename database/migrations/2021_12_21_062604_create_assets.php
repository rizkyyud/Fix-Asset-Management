<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssets extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assets', function (Blueprint $table) {
            $table->increments('id_assets');
            $table->string('nama_assets')->notNullValue();
            $table->integer('id_lokasi')->unsigned();
            $table->integer('id_subLokasi')->unsigned();
            $table->integer('id_kategori')->unsigned();
            $table->integer('id_pemilik')->unsigned();
            $table->bigInteger('nilai_assets');
            $table->integer('luas');
            $table->text('foto')->nullable();
            $table->timestamps();
        });

        // Schema::table('assets', function (Blueprint $table) {
        //     $table->foreign('id_lokasi')->references('id_lokasi')->on('lokasi')->onDelete('cascade')->onUpdate('cascade');
        //     $table->foreign('id_subLokasi')->references('id_subL')->on('sub_lokasi')->onDelete('cascade')->onUpdate('cascade');
        //     $table->foreign('id_kategori')->references('id_kategori')->on('kategori')->onDelete('cascade')->onUpdate('cascade');
        //     $table->foreign('id_pemilik')->references('id_pemilik')->on('pemilik')->onDelete('cascade')->onUpdate('cascade');
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('assets');
    }
}
