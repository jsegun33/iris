<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRequestDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('request_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('RequestNo')->unique();
            $table->string('ProductLine');
            $table->string('PremiumAmount');
            $table->string('AmountDue');
            $table->string('PlateNumber');
            $table->string('Denomination');
            $table->string('MotorPOAmount');
            $table->string('CoverageAmount');
            $table->string('MotorYear');
            $table->string('MotorBrand');
            $table->string('MotorModel');
            $table->string('MotorBodyType');
            $table->string('MotorUsage');
            $table->string('MotorSurcharge');
            $table->string('MotorNetWeight');
            $table->string('MotorWithAccessories');
            $table->string('MotorEffectiveDate');
            $table->string('MotorExpiryDate');
            $table->string('TINNumber');
            $table->string('EmailAddress');
            $table->string('ContactNumber');
            $table->string('FirstName');
            $table->string('MiddleName');
            $table->string('LastName');
            $table->string('Address');
            $table->string('Barangay');
            $table->string('City');
            $table->string('Status');
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
        Schema::dropIfExists('request_details');
    }
}
