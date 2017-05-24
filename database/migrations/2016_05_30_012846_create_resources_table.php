<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResourcesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resources',function(Blueprint $table){
            $table->increments('id');
            $table->integer("user_id");
            $table->string("filename");
            $table->string("type");
            $table->string('real_path');
            $table->string('rela_path');
            $table->nullableTimestamps();
        });        //
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('blogs');
    }
}
