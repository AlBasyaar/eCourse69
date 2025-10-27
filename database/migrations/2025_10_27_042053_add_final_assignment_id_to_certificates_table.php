<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('certificates', function (Blueprint $table) {
            // Tambahkan kolom foreign key. Sesuaikan jika ID assignment bukan bigIncrements
            $table->foreignId('final_assignment_id')
                  ->nullable() // Biarkan nullable jika memungkinkan sertifikat dibuat tanpa assignment (jarang)
                  ->after('course_id') // Letakkan setelah course_id
                  ->constrained('final_assignments') // Asumsikan nama tabel assignments adalah 'final_assignments'
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('certificates', function (Blueprint $table) {
            // Hapus foreign key constraint
            $table->dropConstrainedForeignId('final_assignment_id');
            // Hapus kolom
            // $table->dropColumn('final_assignment_id'); // Jika dropConstrainedForeignId tidak tersedia
        });
    }
};
