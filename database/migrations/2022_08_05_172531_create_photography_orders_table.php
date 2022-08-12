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
        Schema::create('photography_orders', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('event_id')->unsigned()->index()->nullable();
            $table->bigInteger('photography_service_id')->unsigned()->index()->nullable();
            $table->integer('photographers')->nullable();
            $table->integer('cameras')->nullable();
            $table->string('time')->nullable();
            $table->integer('max_images')->nullable();
            $table->string('delivery_method')->nullable();
            $table->string('comment')->nullable();
            $table->string('customization')->nullable();

            $table->timestamps();

            $table->foreign('event_id')->references('id')->on('events')->onDelete('cascade');
            $table->foreign('photography_service_id')->references('id')->on('photography_services')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('photography_orders');
    }
};
