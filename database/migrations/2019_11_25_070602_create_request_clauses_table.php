<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRequestClausesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('request_clauses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('RequestNo');
            $table->string('OptionNo');
            $table->string('Active');
            $table->string('Status');
            $table->string('ClausesNo');
            $table->string('ClausesName');
            $table->string('ClausesStatement');
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
        Schema::dropIfExists('request_clauses');
    }
}
