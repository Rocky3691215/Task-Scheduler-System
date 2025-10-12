<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('account_sync', function (Blueprint $table) {
            $table->id('syncId');
            $table->dateTime('lastSyncTime')->nullable();
            $table->string('deviceId');
            $table->foreignId('userId')->constrained('users');
            $table->unique(['userId', 'deviceId']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('account_sync');
    }
};
