<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Type;
class CreateTypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('type', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('AutoNo');
            $table->string('type_name');
            $table->boolean('active');
            $table->softDeletes();
            $table->timestamps();
        });

        Type::insert([
            'type_name'          => 'File Maintenance',
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
        Schema::dropIfExists('type');
    }
}
