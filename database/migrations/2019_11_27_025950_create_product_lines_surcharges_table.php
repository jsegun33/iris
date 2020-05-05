<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductLinesSurchargesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_lines_surcharges', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('SurchargeNo');
            $table->string('SurchargeName');
            $table->string('Charge');
            $table->string('LinesNo');
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
        Schema::dropIfExists('product_lines_surcharges');
    }
}
