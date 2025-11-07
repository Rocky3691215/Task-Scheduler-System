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
        // Temporarily drop the table to clean up from the failed migration
        Schema::dropIfExists('sync_history');

        Schema::create('sync_history', function (Blueprint $table) {
            $table->id();
            $table->foreignId('account_sync_id')->constrained(
                table: 'account_sync', column: 'syncId'
            )->onDelete('cascade');
            $table->string('status');
            $table->text('message')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sync_history');
    }
};
