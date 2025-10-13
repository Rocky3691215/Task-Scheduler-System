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
        Schema::create('image_attachments', function (Blueprint $table) {
            $table->id();
            $table->string('file_name'); // original file name
            $table->string('file_path'); // storage path
            $table->string('file_type')->nullable(); // optional: jpg, png, etc.
            $table->unsignedBigInteger('file_size')->nullable(); // optional: file size in bytes
            $table->morphs('attachable'); // for polymorphic relation (can attach to any model)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('image_attachments');
    }
};

