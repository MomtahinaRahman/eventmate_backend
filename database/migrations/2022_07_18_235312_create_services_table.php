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
        Schema::create('services', function (Blueprint $table) {
            //$table->increments('id');
            $table->id();
            $table->string('name');
            //$table->unsignedBigInteger('user_id');
            //$table->integer('user_id')->unsigned()->index();
            $table->bigInteger('user_id')->unsigned()->index()->nullable();
            //$table->unsignedBigInteger('vendor_id');
            //$table->integer('vendor_id')->unsigned()->index();
            $table->bigInteger('vendor_id')->unsigned()->index()->nullable();
            $table->string('description')->nullable();
            $table->integer('price');
            $table->string('inform')->nullable();
            $table->string('build')->nullable();
            $table->integer('placement')->nullable();
            $table->string('space')->nullable();
            $table->integer('guest')->nullable();
            $table->string('colors')->nullable();
            $table->integer('customization')->nullable();
            $table->string('location')->nullable();
            $table->timestamps();

            $table->foreign('vendor_id')->references('id')->on('vendors')->onDelete('cascade');
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
        Schema::dropIfExists('services');
    }
};
