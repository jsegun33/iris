<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarDenominationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('car_denominations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('DenominationNo');
            $table->string('DenominationCode');
            $table->string('DenominationName');
            $table->string('Class');
            $table->boolean('Active');
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
        Schema::dropIfExists('car_denominations');
    }
}
