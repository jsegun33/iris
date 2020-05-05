<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRequestSurchargeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('request_surcharge', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('SurchargeNo')->unique();
            $table->string('RequestNo');
            $table->string('SurchargeName');
            $table->string('SurchargeAmount');
            $table->string('SurchargePremium');
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
        Schema::dropIfExists('request_surcharge');
    }
}
