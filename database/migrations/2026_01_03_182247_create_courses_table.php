<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->id();

            // Relasi ke User (Instruktur) & Kategori
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Instruktur
            $table->foreignId('category_id')->constrained()->onDelete('cascade'); // Kategori

            $table->string('name');
            $table->string('slug')->unique();
            $table->string('thumbnail')->nullable(); // Gambar Sampul Kursus
            $table->text('description')->nullable(); // Penjelasan singkat
            $table->longText('content')->nullable(); // Bisa untuk silabus/detail
            $table->integer('price')->default(0); // 0 = Gratis
            $table->boolean('is_published')->default(false); // Draft / Tayang

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
