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
        Schema::create('photography_services', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned()->index()->nullable();
            $table->bigInteger('vendor_id')->unsigned()->index()->nullable();
            $table->integer('cameras')->nullable();
            $table->integer('photographers')->nullable();
            $table->string('time')->nullable();
            $table->integer('price')->nullable();
            $table->string('portfolio')->nullable();
            $table->string('professional_editing')->nullable();
            $table->integer('max_images')->nullable();
            $table->string('delivery_method')->nullable();
            $table->string('description')->nullable();
            $table->string('phone')->nullable();
            $table->string('studio')->nullable();
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
        Schema::dropIfExists('photography_services');
    }
};
