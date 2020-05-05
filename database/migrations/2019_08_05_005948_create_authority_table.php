<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Authority;

class CreateAuthorityTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('authority', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('authority_name');
            $table->string('active');
            $table->softDeletes();
            $table->timestamps();
        });
        Authority::insert([
            'authority_name'     => 'Admin',
            'active'             => 1,
           
           
        ]);
        

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('authority');
    }
}
