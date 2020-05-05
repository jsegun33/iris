<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductLinesPerilsTaripasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_lines_perils_taripa', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('TaripaNo');
            $table->string('SubLinesNo');
            $table->string('PerilsNo');
            $table->string('CoverageAmount');
            $table->string('PremiumAmount');
            $table->string('Formula');
            $table->string('PerilsName');
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
        Schema::dropIfExists('product_lines_perils_taripa');
    }
}
