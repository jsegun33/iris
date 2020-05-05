<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductLinesPerilsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_lines_perils', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('PerilsNo');
            $table->string('PerilsCode');
            $table->string('PerilsName');
            $table->string('Checkbox');
            $table->string('Checkbox1');
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
        Schema::dropIfExists('product_lines_perils');
    }
}
