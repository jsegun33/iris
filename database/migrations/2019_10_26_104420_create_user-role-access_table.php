<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserRoleAccessTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_role_access', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('AccountNo');
            $table->string('role_name-access');
            $table->string('role_number-access');           
            $table->string('active');
            $table->string('status');
            $table->unsignedBigInteger('acctTypeSub');
            $table->string('acctTypeSubName');
          
           
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
        //
    }
}
