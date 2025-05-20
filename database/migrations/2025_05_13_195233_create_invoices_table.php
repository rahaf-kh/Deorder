<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->text('content');
            $table->double('price');
            $table->double('total');
            $table->unsignedBigInteger('delivery_id');
            $table->foreign('delivery_id')->on('deliveries')->references('id');
            $table->unsignedBigInteger('order_id');
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
