<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('admin_notifications', function (Blueprint $table) {
            $table->id();
            // $table->string('title');
            // $table->text('body');
            // $table->unsignedBigInteger('user_id');
            // $table->foreign('user_id')->on('users')->references('id');
            // $table->unsignedBigInteger('order_id');
            // $table->boolean('read');
            // $table->timestamp('date');
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('admin_notifications');
    }
};
