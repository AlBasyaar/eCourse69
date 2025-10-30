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
        // Menambahkan kolom 'material_url' yang bersifat nullable (opsional)
        Schema::table('course_videos', function (Blueprint $table) {
            $table->string('material_url')->nullable()->after('cloudinary_url');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Menghapus kolom 'material_url'
        Schema::table('course_videos', function (Blueprint $table) {
            $table->dropColumn('material_url');
        });
    }
};