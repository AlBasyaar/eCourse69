<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('final_assignments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // Siswa
            $table->foreignId('course_id')->constrained('courses')->onDelete('cascade');
            $table->foreignId('mentor_id')->nullable()->constrained('mentors')->onDelete('set null'); // Mentor yang mengoreksi
            $table->string('file_path');
            $table->text('mentor_feedback')->nullable();
            $table->enum('status', ['submitted', 'revisi', 'approved'])->default('submitted');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('final_assignments');
    }
};