<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\User;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('user_fname');
            $table->string('user_mname');
            $table->string('user_lname');
            $table->string('username');
            $table->string('acctType');
            $table->string('userRole');
            $table->string('department');
            $table->string('departmentID');		
            $table->string('active');
            $table->string('status');
            $table->string('AccountNo')->unique();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });

        $curYear = date('Y'); 
        $AccountNo =  $curYear. "-0001";
        User::insert([
            'user_fname'    => 'Erika',
            'user_lname'    => 'Ferrera',
            'department'    => 'IT-Head',
            'userRole'      => 'Super Admin',
            'username'      => 'admin',
            'email'         => 'admin@iristech.ph',
            'password'      => bcrypt::make('12345678'),
            'ApprovedLimit' => 1000000,
            'AccountNo'     => $AccountNo,
            'created_at'    => now(),
            'updated_at'    => now(),
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
