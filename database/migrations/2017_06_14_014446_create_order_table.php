<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order', function($table){
            $table->increments('id');
            $table->integer('user_id');
            $table->string('receiver', 50);
            $table->string('tel', 11);
            $table->string('city', 20);
            $table->string('location', 50);
            $table->string('fast_shot', 2000);
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
        //
    }
}
