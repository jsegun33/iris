<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductLinesChargesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_lines_charges', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('ChargesNo')->unique();
            $table->string('ChargesCode');
            $table->string('ChargesName');
            $table->double('ChargesAmount');
            $table->string('ChargesRemarks')->nullable();
            $table->string('ProductLine');
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
        Schema::dropIfExists('product_lines_charges');
    }
}
