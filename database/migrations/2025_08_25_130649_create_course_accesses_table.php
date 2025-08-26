<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('course_accesses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // Siswa
            $table->foreignId('course_id')->constrained('courses')->onDelete('cascade');
            $table->boolean('is_active')->default(false); // Status akses kursus
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('course_accesses');
    }
};