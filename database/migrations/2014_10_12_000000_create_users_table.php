<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('mobile')->unique();
            $table->uuid('uuid')->unique();
            $table->string('profile_image')->nullable();
            $table->double('subscription_fees')->default(75000);
            $table->text('address');
            $table->text('bio')->nullable();
            $table->boolean('active')->default(false);
            $table->date('expire')->nullable();
            $table->unsignedBigInteger('area_id');
            $table->boolean('blocked')->default(false);
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
