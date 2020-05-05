<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuotationCustomerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        Schema::create('quotation_customer', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('firstname');
            $table->string('middlename');
            $table->string('lastname');
            $table->string('Address');
            $table->string('ContactNo');
            $table->string('CustAcctNo')->unique();
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
        Schema::dropIfExists('quotation_customer');
    }
}
