<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaction', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_from');
            $table->unsignedBigInteger('user_to');
            $table->string('subject');
            $table->string('comment')->nullable();
            $table->float('quantity');
            $table->timestamps();

            $table->foreign('user_from')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('user_to')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaction');
    }
}
