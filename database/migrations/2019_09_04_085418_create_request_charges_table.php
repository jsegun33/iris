<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRequestChargesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('request_charges', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('ChargesNo')->unique();
            $table->string('RequestNo');
            $table->string('ChargesName');
            $table->string('ChargesAmount');
            $table->string('ChargesPremium');
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
        Schema::dropIfExists('request_charges');
    }
}
