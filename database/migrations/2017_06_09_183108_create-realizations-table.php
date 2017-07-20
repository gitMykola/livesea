<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRealizationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('realizations');
        Schema::create('realizations', function (Blueprint $table) {
            $table->increments('id');
            $table->char('name',50)->index();
            $table->integer('task_id')->unsigned();
            $table->integer('executor_id')->unsigned();
            $table->string('text');
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
        Schema::dropIfExists('realizations');
    }
}
