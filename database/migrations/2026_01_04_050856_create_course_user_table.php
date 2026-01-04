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
        Schema::create('course_user', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('course_id')->constrained()->onDelete('cascade');
            $table->integer('progress')->default(0); // Menyimpan progres persen (0-100)
            $table->enum('status', ['active', 'completed'])->default('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
public function down()
{
    Schema::dropIfExists('course_user');
}
};
