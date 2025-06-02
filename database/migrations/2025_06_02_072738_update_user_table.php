<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->double('subscription_fees')->dafault(75000);
            $table->text('bio')->nullable();
            $table->boolean('active')->default(false);
            $table->date('expire')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('subscription_fees');
            $table->dropColumn('bio');
            $table->dropColumn('active');
            $table->dropColumn('expire');
        });
    }
};
