<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarClassesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('car_classes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('SubLinesClassNo');
            $table->string('ClassName');
            $table->string('ClassInputNo');
            $table->string('ClassNo');
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
        Schema::dropIfExists('car_classes');
    }
}
