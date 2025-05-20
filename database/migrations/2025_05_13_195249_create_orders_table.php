<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            // $table->uuid('uuid');
            $table->text('order');
            $table->enum('status',['completed','inProgress','waiting']);
            $table->unsignedBigInteger('delivery_id');
            $table->foreign('delivery_id')->on('deliveries')->references('id');
            $table->timestamp('scheduled_time');//order time 
            $table->timestamp('estimated_time');//stimated order arrival time
            $table->timestamp('start_delivery_time');
            $table->timestamp('received_time');
            $table->boolean('canceled')->nullable();
            $table->string('canceled_text');
            $table->text('images')->nullable();
            $table->unsignedBigInteger('customer_id');
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
