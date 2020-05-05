<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuotationListTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quotation_list', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('QuoteNo')->unique();
            $table->string('plate_number');
            $table->string('CustAcctNo');
            $table->string('CTPL');
            $table->string('CTPLAmount');
            $table->string('CTPLPremium');
            $table->string('OD');
            $table->string('ODAmount');
            $table->string('ODPremium');
            $table->string('TH');
            $table->string('THLAmount');
            $table->string('THPremium');
            $table->string('AOG');
            $table->string('AOGAmount');
            $table->string('AOGPremium');
            $table->string('xBI');
            $table->string('xBIAmount');
            $table->string('xBIPremium');
            $table->string('PD');
            $table->string('PDAmount');
            $table->string('PDPremium');
            $table->string('PA');
            $table->string('PAAmount');
            $table->string('PAPremium');
            $table->string('TotalCoverage');
            $table->string('DocStps');
            $table->string('Vat');
            $table->string('LGT');
            $table->string('COCFee');
            $table->string('BayadCenter');
            $table->string('GrossAmount');
            $table->string('Discount');
            $table->string('DiscountRemarks');
            $table->string('TotalPremium');

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
        Schema::dropIfExists('quotation_list');
    }
}
