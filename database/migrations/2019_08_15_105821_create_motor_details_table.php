<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMotorDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('motor_details', function (Blueprint $table) {
            $table->bigIncrements('id');  
            $table->string('plate_number')->unique();         
            $table->string('mv_file_number');           
            $table->string('engine_number');
            $table->string('chassis_number');
            $table->string('make_id');
            $table->string('series_id');
            $table->string('body_id');
            $table->string('mv_id');
            $table->string('color');
            $table->string('CustAcctNo');

            
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
        Schema::dropIfExists('motor_details');
    }
}
