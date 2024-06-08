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
            $table->string('phone', 255)->nullable();
            $table->string('email', 255)->nullable();
            $table->date('bdate')->nullable();
            $table->string('streetname', 255)->nullable();
            $table->string('region', 255)->nullable();
            $table->string('city', 255)->nullable();
            $table->smallInteger('appno')->nullable();
            $table->string('buildingno',255)->nullable();
            $table->smallInteger('floorno')->nullable();
            $table->string('country', 255)->nullable();
            $table->string('church', 255)->nullable();
            $table->string('churchlocation', 255)->nullable();
            $table->string('churchcity', 255)->nullable();
            $table->string('churchcountry', 255)->nullable();
            $table->tinyInteger('type')->nullable();
            $table->tinyInteger('yearofstudy')->nullable();
            $table->string('schoolname', 255)->nullable();
            $table->string('degree', 255)->nullable();
            $table->string('job', 255)->nullable();
            $table->string('company', 255)->nullable();
            $table->tinyInteger('service')->nullable();
            $table->string('servicename', 255)->nullable();
            $table->string('servicechurch', 255)->nullable();
            $table->date('entrydate')->nullable();
            $table->integer('formno')->unique();
            $table->string('category', 50)->nullable();
            $table->string('whocreated', 50)->nullable();
            $table->tinyInteger('active')->nullable();
            $table->string('soundlike', 90)->nullable();
            $table->softDeletes();
            $table->date('last_login')->nullable();
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
