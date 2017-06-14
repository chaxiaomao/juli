<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddressTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('address', function($table){
            $table->increments('id');
            $table->integer('user_id');
            $table->string('receiver', 50);
            $table->string('tel', 11);
            $table->string('city', 20);
            $table->string('location', 50);
            $table->tinyinteger('default');
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
