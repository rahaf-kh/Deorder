<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('work_times', function (Blueprint $table) {
            $table->id();
            $table->enum('date_name',['summer','winter']);
            $table->time('from');
            $table->time('to');
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('work_times');
    }
};
