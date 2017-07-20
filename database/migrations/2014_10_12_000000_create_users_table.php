<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('users');
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('private_info')->unsigned()->nullable();
            $table->char('email',100)->index();
            $table->char('name',100);
            $table->char('password',255);
            $table->integer('location')->unsigned()->nullable();
            $table->integer('avatar')->unsigned()->nullable();
            $table->integer('role')->unsigned()->nullable();
            $table->integer('referal')->unsigned()->nullable();
            $table->integer('status')->unsigned()->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
