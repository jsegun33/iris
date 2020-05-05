<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Userrole;

class CreateUserRoleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        $curYear = date('Y'); 
        $AccountNo =  $curYear. "-0001";
        Schema::create('user_roles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('AccountNo');
            $table->string('role_name');
            $table->string('role_number');           
            $table->string('active');
            $table->string('status');
            $table->unsignedBigInteger('acctType');
            $table->string('acctTypeName');
          
           
            $table->timestamps();
        });

        Userrole::insert([
            'AccountNo'       => $AccountNo,
            'role_name'      => 'Admin',
            'acctType'       => '1',
            'role_number'    => '1',
            'active'         => '1',
            'status'         => '1',
            
           
        ]);
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
