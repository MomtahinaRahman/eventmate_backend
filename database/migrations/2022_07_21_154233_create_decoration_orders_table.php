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
        Schema::create('decoration_orders', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('event_id')->unsigned()->index()->nullable();
            $table->bigInteger('service_id')->unsigned()->index()->nullable();
            $table->integer('quantity')->nullable();
            $table->string('comment')->nullable();
            $table->integer('placement')->nullable();
            $table->string('space')->nullable();
            $table->integer('guest')->nullable();
            $table->string('colors')->nullable();
            $table->string('customization')->nullable();
            $table->timestamps();

            $table->foreign('event_id')->references('id')->on('events')->onDelete('cascade');
            $table->foreign('service_id')->references('id')->on('services')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('decoration_orders');
    }
};
