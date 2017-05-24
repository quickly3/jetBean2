<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CraeteBlogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blogs', function (Blueprint $table) {
            
            $table->increments('id');
            $table->integer("user_id")->default(0);
            $table->string('title');
            $table->string('summary');
            $table->text('content');
            $table->string('main_img')->default("");
            $table->string('thumbnailUrl');
            $table->rememberToken();
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


