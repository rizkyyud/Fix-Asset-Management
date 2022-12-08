<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReqPesanansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('req_pesanans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('id_cart');
            $table->bigInteger('id_checker');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('req_pesanans');
    }
}
