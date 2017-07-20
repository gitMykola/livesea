<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMediasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('medias');
        Schema::create('medias', function (Blueprint $table) {
            $table->increments('id');
            $table->string('path',190)->index();
            $table->integer('author')->unsigned()->index();
            $table->char('alt',190)->index();
            $table->char('href',190)->index();
            $table->integer('type')->unsigned();
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
        Schema::dropIfExists('medias');
    }
}
