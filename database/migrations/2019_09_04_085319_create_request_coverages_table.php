<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRequestCoveragesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('request_coverages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('CoveragesNo')->unique();
            $table->string('RequestNo');
            $table->string('CoveragesName');
            $table->string('CoveragesAmount');
            $table->string('PremiumAmount');
            $table->string('CoveragesPremium');
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
        Schema::dropIfExists('request_coverages');
    }
}
