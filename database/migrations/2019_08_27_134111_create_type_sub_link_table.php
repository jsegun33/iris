<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\TypeSubLink;
use App\Type;
class CreateTypeSubLinkTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
     
      $GetTypeID = Type::where('active', 1)->first();
        Schema::create('type_sub_link', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('SubLink_TypeName');
            $table->string('SubLink_URL');
            $table->string('type_name');
            $table->string('type_ID');
            $table->string('active');
            $table->timestamps();
        });


        TypeSubLink::insert([
            'SubLink_TypeName'    => 'Registration',
            'SubLink_URL'         => '/registration',
            'type_name'           => 'File Maintenance',
            'type_ID'             => trim($GetTypeID->_id),
            'active'              => '1',
           
        ]);
        TypeSubLink::insert([
            'SubLink_TypeName'    => 'Authority',
            'SubLink_URL'         => '/authority',
            'type_name'           => 'File Maintenance',
            'type_ID'             => trim($GetTypeID->_id),
            'active'              => '1',
           
        ]);
		

        TypeSubLink::insert([
            'SubLink_TypeName'    => 'Type',
            'SubLink_URL'         => '/type',
            'type_name'           => 'File Maintenance',
            'type_ID'             => trim($GetTypeID->_id),
            'active'              => '1',
           
        ]);
		TypeSubLink::insert([
            'SubLink_TypeName'    => 'Sub-Type',
            'SubLink_URL'         => '/Sub-Type',
            'type_name'           => 'File Maintenance',
            'type_ID'             => trim($GetTypeID->_id),
            'active'              => '1',
           
        ]);
        TypeSubLink::insert([
            'SubLink_TypeName'    => 'Department',
            'SubLink_URL'         => '/department',
            'type_name'           => 'File Maintenance',
            'type_ID'             => trim($GetTypeID->_id),
            'active'              => '1',
           
        ]);

        TypeSubLink::insert([
            'SubLink_TypeName'    => 'List',
            'SubLink_URL'         => '/proposal-lists',
            'type_name'           => 'Proposal',
            'type_ID'             => trim($GetTypeID->_id),
            'active'              => '1',
           
        ]);
        TypeSubLink::insert([
            'SubLink_TypeName'    => 'Quotation',
            'SubLink_URL'         => '/request-form',
            'type_name'           => 'Proposal',
            'type_ID'             => trim($GetTypeID->_id),
            'active'              => '1',
           
        ]);


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('type_sub_link');
    }
}
