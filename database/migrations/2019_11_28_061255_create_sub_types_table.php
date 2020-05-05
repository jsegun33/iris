<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sub_types', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('SubLink_TypeName');
            $table->string('SubLink_URL');
            $table->string('SubMenu_Type');
            $table->string('TypeID');
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
        Schema::dropIfExists('sub_types');
    }
}
