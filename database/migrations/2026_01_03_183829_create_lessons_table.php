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
        Schema::create('lessons', function (Blueprint $table) {
            $table->id();
            $table->foreignId('module_id')->constrained('modules')->onDelete('cascade');
            $table->string('title');
            $table->string('slug');
            $table->string('video_url')->nullable(); // Link Youtube/Vimeo
            $table->string('file_attachment')->nullable(); // Upload File PDF/Doc
            $table->text('content_text')->nullable(); // Materi Teks
            $table->enum('type', ['video', 'text', 'document'])->default('video');
            $table->boolean('is_preview')->default(false); // Bisa ditonton gratis?
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lessons');
    }
};
