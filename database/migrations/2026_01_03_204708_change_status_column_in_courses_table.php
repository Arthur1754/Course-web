<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('courses', function (Blueprint $table) {
            // Hapus kolom lama (True/False)
            $table->dropColumn('is_published');

            // Tambah kolom baru dengan opsi status
            $table->enum('status', ['draft', 'pending', 'published', 'rejected'])->default('draft');
        });
    }

    public function down()
    {
        Schema::table('courses', function (Blueprint $table) {
            $table->dropColumn('status');
            $table->boolean('is_published')->default(false);
        });
    }
};
