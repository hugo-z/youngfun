<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBabyfunTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parent_info', function (Blueprint $table) {
            $table->increments('id');
            $table->string('uniqueid', 256)->unique()->nullable();
            // $table->string('open_id', 256);
            $table->string('cell', 11)->nullable();
            $table->string('nickname', 50);
            $table->enum('gender', ['n', 'm', 'f'])->default('n');
            $table->enum('lang', ['en', 'zh'])->default('zh');
            $table->string('country', 50);
            $table->string('province', 50);
            $table->string('city', 50);
            $table->timestamps();
        });

        Schema::create('baby_info', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('pid')->unsigned();
            $table->string('name', 30);
            $table->enum('gender', ['m', 'f'])->default('m');
            $table->date('bday');
            $table->timestamps();

            $table->foreign('pid')->references('id')->on('parent_info');
        });

        Schema::create('parent_openid', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('pid')->unsigned();
            $table->string('openid', 256);
            $table->timestamps();

            $table->foreign('pid')->references('id')->on('parent_info');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('baby_info');
    }
}
