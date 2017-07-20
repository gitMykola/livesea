<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('transactions');
        Schema::create('transactions', function (Blueprint $table) {
            $table->increments('id');
            $table->char('name',50)->index();
            $table->integer('wallet')->unsigned()->references('id')->on('wallets');
            $table->integer('debet_agent_id')->unsigned();
            $table->integer('credit_agent_id')->unsigned();
            $table->float('amount');
            $table->integer('currency')->unsigned();
            $table->integer('status')->unsigned();
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
        Schema::dropIfExists('transactions');
    }
}
