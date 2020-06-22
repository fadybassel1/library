<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReadersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('readers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 255);
            $table->string('phone', 11)->nullable();
            $table->string('email', 50)->nullable();

            $table->date('bdate')->nullable();
            $table->string('streetname', 50)->nullable();
            $table->string('region', 50)->nullable();
            $table->string('city', 50)->nullable();
            $table->smallInteger('appno')->nullable();
            $table->smallInteger('buildingno')->nullable();
            $table->smallInteger('floorno')->nullable();
            $table->string('country', 50)->nullable();
            $table->string('church', 50)->nullable();
            $table->string('churchlocation', 50)->nullable();
            $table->string('churchcity', 50)->nullable();
            $table->string('churchcountry', 50)->nullable();
            $table->tinyInteger('type')->nullable();
            $table->tinyInteger('yearofstudy')->nullable();
            $table->string('schoolname', 50)->nullable();
            $table->string('degree', 50)->nullable();
            $table->string('job', 50)->nullable();
            $table->string('company', 50)->nullable();
            $table->tinyInteger('service')->nullable();
            $table->string('servicename', 50)->nullable();
            $table->string('servicechurch', 50)->nullable();
            $table->date('entrydate')->nullable();
            $table->integer('formno')->unique();
            $table->string('category', 50)->nullable();
            $table->string('whocreated', 50)->nullable();
            $table->tinyInteger('active')->nullable();
            $table->string('soundlike', 90)->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('readers');
    }
}
