<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendors', function (Blueprint $table) {

            //$table->('id');
            $table->id();
            $table->string('name');
            //$table->unsignedBigInteger('user_id');
            //$table->integer('user_id')->unsigned()->index();
            $table->bigInteger('user_id')->unsigned()->index()->nullable();
            //$table->index('user_id');
            $table->integer('category')->nullable();
            $table->string('email')->unique();
            $table->string('phone')->nullable();
            $table->integer('response')->nullable();
            $table->integer('review')->nullable();
            $table->integer('ratings')->nullable();
            $table->string('address')->nullable();
            $table->string('areas')->nullable();
            $table->string('licence')->nullable();
            $table->string('about')->nullable();
            $table->string('logo')->nullable();
            $table->string('fb')->nullable();
            $table->string('insta')->nullable();
            $table->string('whatsapp')->nullable();
            $table->string('linkedin')->nullable();
            $table->string('youtube')->nullable();
            $table->integer('established')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vendors');
    }
};
