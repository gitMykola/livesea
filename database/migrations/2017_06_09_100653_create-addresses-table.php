<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('addresses');
        Schema::create('addresses', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->char('name',100);
            $table->integer('country')->unsigned();
            $table->integer('city')->unsigned();
            $table->integer('street')->unsigned();
            $table->char('home',10)->index();
            $table->char('apartment',10)->index();
            $table->integer('location')->unsigned();
            $table->boolean('show');
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
        Schema::dropIfExists('addresses');
    }
}
