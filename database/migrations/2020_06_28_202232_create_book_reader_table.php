<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookReaderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('book_reader', function (Blueprint $table) {
            $table->bigInteger('book_id')->unsigned();
            $table->bigInteger('reader_id')->unsigned();
            $table->primary(['book_id', 'reader_id']);
            $table->foreign('book_id')->references('id')->on('books');
            $table->foreign('reader_id')->references('id')->on('readers');
            $table->dateTime('date_read', 0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('book_reader');
    }
}
