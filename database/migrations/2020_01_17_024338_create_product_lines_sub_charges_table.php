<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductLinesSubChargesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_lines_sub_charges', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('ChargesNo');
            $table->string('ChargesName');
            $table->string('SubChargesName');
            $table->string('SubChargesNo');
            $table->string('SubChargesCode');
            $table->string('SubChargesAmount');
            $table->string('SubChargesRemarks');
            $table->string('Active');
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
        Schema::dropIfExists('product_lines_sub_charges');
    }
}
