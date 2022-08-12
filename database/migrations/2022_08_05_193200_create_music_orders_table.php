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
        Schema::create('music_orders', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('event_id')->unsigned()->index()->nullable();
            $table->bigInteger('music_service_id')->unsigned()->index()->nullable();
            $table->integer('djs')->nullable();
            $table->string('time')->nullable();
            $table->string('lights')->nullable();
            $table->integer('soundbox')->nullable();
            $table->integer('wireless_microphones')->nullable();
            $table->string('song_lists')->nullable();
            $table->string('comment')->nullable();
            $table->string('customization')->nullable();
            $table->timestamps();

            $table->foreign('event_id')->references('id')->on('events')->onDelete('cascade');
            $table->foreign('music_service_id')->references('id')->on('music_services')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('music_orders');
    }
};
