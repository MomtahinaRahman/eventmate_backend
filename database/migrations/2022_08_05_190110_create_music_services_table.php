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
        Schema::create('music_services', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned()->index()->nullable();
            $table->bigInteger('vendor_id')->unsigned()->index()->nullable();
            $table->integer('djs')->nullable();
            $table->string('time')->nullable();
            $table->integer('max_songs')->nullable();
            $table->string('lights')->nullable();
            $table->integer('soundbox')->nullable();
            $table->integer('wireless_microphones')->nullable();
            $table->integer('price')->nullable();

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
        Schema::dropIfExists('music_services');
    }
};
