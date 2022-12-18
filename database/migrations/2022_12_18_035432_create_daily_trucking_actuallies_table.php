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
        Schema::create('daily_trucking_actuallies', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('daily_trucking_plan_id');
            $table->unsignedBigInteger('destination_1_id')->nullable();
            $table->unsignedBigInteger('destination_2_id')->nullable();
            $table->unsignedBigInteger('destination_3_id')->nullable();
            $table->integer('price');
            $table->string('renban');
            $table->double('container_size');
            $table->foreign('daily_trucking_plan_id')->references('id')->on('daily_trucking_plans');
            $table->foreign('destination_1_id')->references('id')->on('destinations');
            $table->foreign('destination_2_id')->references('id')->on('destinations');
            $table->foreign('destination_3_id')->references('id')->on('destinations');
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
        Schema::dropIfExists('daily_trucking_actuallies');
    }
};
