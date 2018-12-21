<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBorrowsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('borrows', function (Blueprint $table) {
          $table->increments('id');
          $table->dateTime('borrowdate');
          $table->dateTime('borrowend');
          $table->boolean('return');
          $table->integer('members_id')->unsigned();
          $table->integer('books_id')->unsigned();
          $table->foreign('members_id')->references('id')->on('members')->onDelete('cascade');
          $table->foreign('books_id')->references('id')->on('books')->onDelete('cascade');
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
        Schema::dropIfExists('borrows');
    }
}
