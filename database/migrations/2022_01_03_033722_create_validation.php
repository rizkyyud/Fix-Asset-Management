<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateValidation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('validation', function (Blueprint $table) {
            $table->increments('id_validator');
            $table->integer('id_orders')->unsigned();
            // $table->enum('status', ['Approve', 'Revision', 'Request', 'Reject'])->default('Request');
            $table->timestamps();
        });
        // Schema::table('validation', function (Blueprint $table) {
        //     $table->foreign('id_orders')->references('id_orders')->on('orders')->onDelete('cascade')->onUpdate('cascade');
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('validation');
    }
}
