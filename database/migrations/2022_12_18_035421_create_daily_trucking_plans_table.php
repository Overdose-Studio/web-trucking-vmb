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
        Schema::create('daily_trucking_plans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('shipment_id');
            $table->unsignedBigInteger('destination_1_id')->nullable();
            $table->unsignedBigInteger('destination_2_id')->nullable();
            $table->unsignedBigInteger('destination_3_id')->nullable();
            $table->integer('price');
            $table->enum('order_type', ['export', 'import']);
            $table->unsignedBigInteger('client_id');
            $table->unsignedBigInteger('truck_id');
            $table->foreign('shipment_id')->references('id')->on('shipments');
            $table->foreign('destination_1_id')
                ->references('id')
                ->on('destinations')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('destination_2_id')
                ->references('id')
                ->on('destinations')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('destination_3_id')
                ->references('id')
                ->on('destinations')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('client_id')
                ->references('id')
                ->on('clients')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('truck_id')
                ->references('id')
                ->on('trucks')
                ->onUpdate('cascade')
                ->onDelete('cascade');
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
        Schema::dropIfExists('daily_trucking_plans');
    }
};
