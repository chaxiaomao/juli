<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user', function($table){
            $table->increments('id');
            $table->string('username', 50);
            $table->string('avatar');
//            $table->string('email', 100)->unique();
            $table->string('phone',11);
            $table->string('password', 64);
            $table->string('ip');
            $table->integer('agent_id');
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
        Schema::drop('user');
    }
}
