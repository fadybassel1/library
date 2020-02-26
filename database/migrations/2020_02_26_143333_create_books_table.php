<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->mediumText('book_name')->nullable();
            $table->mediumText('book_publisher')->nullable();
            $table->mediumText('book_author')->nullable();
            $table->longText('book_description')->nullable();
            $table->string('book_desc')->nullable();
            $table->string('book_position')->nullable();
            $table->string('dewy_tenth')->nullable();
            $table->string('col_8')->nullable();
            $table->string('book_seriesno')->nullable();
            $table->string('book_seriesname')->nullable();
            $table->string('book_col11')->nullable();
            $table->integer('book_access')->nullable();
            $table->tinyInteger('book_creator')->nullable();

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
        Schema::dropIfExists('books');
    }
}
