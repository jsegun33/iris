<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\DefaultData;

class CreateProductsDefaultDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products_default_data', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('DefaultDataNo')->unique();
            $table->string('LinesNo');
            $table->string('PerilsClass');
            $table->string('Name');
            $table->string('Amount');
            $table->string('Converter');
            $table->string('Active');
            $table->timestamps();
        });

        DefaultData::insert([
            'DefaultDataNo'           => '2019-RE-0001',
            'LinesNo'                 => '2019-PC-0001',
            'Name'                    => 'Rate Percentage',
            'Amount'                  =>  '1.3',
            'Converter'               => 'Percent',
            'Active'                  => '1',
        ]);
        
        DefaultData::insert([
            'DefaultDataNo'           => '2019-NS-0002',
            'LinesNo'                 => '2019-PC-0001',
            'Name'                    => 'Number of Days',
            'Amount'                  =>  '360',
            'Converter'               => 'Decimal',
            'Active'                  => '1',
        ]);
        DefaultData::insert([
            'DefaultDataNo'           => '2019-CT-0003',
            'LinesNo'                 => '2019-PC-0001',
            'Name'                    => 'Coverage Amount',
            'Amount'                  =>  100000,
            'Converter'               => 'Decimal',
            'Active'                  => '1',
        ]);
        DefaultData::insert([
            'DefaultDataNo'           => '2019-DE-0004',
            'LinesNo'                 => '2019-PC-0001',
            'PerilsClass'             => '2019-PC-0001',
            'Name'                    => 'Deductible',
            'Amount'                  =>  '0.005',
            'Converter'               => 'Percent',
            'Active'                  => '1',
        ]);
        DefaultData::insert([
            'DefaultDataNo'           => '2019-DE-0005',
            'LinesNo'                 => '2019-PC-0001',
            'PerilsClass'             => '2019-PC-0002',
            'Name'                    => 'Deductible',
            'Amount'                  =>  '0.001',
            'Converter'               => 'Percent',
            'Active'                  => '1',
        ]);
        DefaultData::insert([
            'DefaultDataNo'           => '2019-DS-0006',
            'LinesNo'                 => '2019-PC-0001',
            'PerilsClass'             => '',
            'Name'                    => 'Doc Stamp',
            'Amount'                  =>  "0.125",
            'Converter'               => 'Percent',
            'Active'                  => '1',
        ]);
        DefaultData::insert([
            'DefaultDataNo'           => '2019-DS-0007',
            'LinesNo'                 => '2019-PC-0001',
            'PerilsClass'             => '',
            'Name'                    => 'Bayad Center',
            'Amount'                  =>  "9.5",
            'Converter'               => 'Decimal',
            'Active'                  => '1',
        ]);
        DefaultData::insert([
            'DefaultDataNo'           => '2019-VT-0008',
            'LinesNo'                 => '2019-PC-0001',
            'PerilsClass'             => '',
            'Name'                    => 'VAT',
            'Amount'                  =>  "0.12",
            'Converter'               => 'Decimal',
            'Active'                  => '1',
        ]);

        DefaultData::insert([
            'DefaultDataNo'           => '2019-DS-0009',
            'LinesNo'                 => '2019-PC-0001',
            'PerilsClass'             => '',
            'Name'                    => 'Road Side Acc',
            'Amount'                  =>  "300",
            'Converter'               => 'Decimal',
            'Active'                  => '1',
        ]);
        DefaultData::insert([
            'DefaultDataNo'           => '2019-CC-0010',
            'LinesNo'                 => '2019-PC-0001',
            'PerilsClass'             => '',
            'Name'                    => 'COC Doc',
            'Amount'                  =>  "84.86",
            'Converter'               => 'Decimal',
            'Active'                  => '1',
        ]);
        DefaultData::insert([
            'DefaultDataNo'           => '2019-LT-0011',
            'LinesNo'                 => '2019-PC-0001',
            'PerilsClass'             => '',
            'Name'                    => 'LGT',
            'Amount'                  =>  "0.00121",
            'Converter'               => 'Decimal',
            'Active'                  => '1',
        ]);
        DefaultData::insert([
            'DefaultDataNo'           => '2019-SE-0012',
            'LinesNo'                 => '2019-PC-0001',
            'PerilsClass'             => '',
            'Name'                    => 'Surcharge',
            'Amount'                  =>  "1.2",
            'Converter'               => 'Decimal',
            'Active'                  => '1',
        ]);

        DefaultData::insert([
            'DefaultDataNo'           => '2019-DE-0013',
            'LinesNo'                 => '2019-PC-0001',
            'PerilsClass'             => '',
            'Name'                    => 'Default Detuctible',
            'Amount'                  =>  "2000",
            'Converter'               => 'Decimal',
            'Active'                  => '1',
        ]);

        DefaultData::insert([
            'DefaultDataNo'           => '2019-CR-0014',
            'LinesNo'                 => '2019-PC-0001',
            'PerilsClass'             => '',
            'Name'                    => 'Josephine Bino',
            'Amount'                  =>  "0",
            'Converter'               => 'NONE',
            'Active'                  => '1',
        ]);
		
		

        

        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products_default_data');
    }
}
