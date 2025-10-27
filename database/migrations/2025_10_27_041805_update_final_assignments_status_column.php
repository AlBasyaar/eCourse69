<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Ubah kolom ENUM dengan menambahkan 'certificate_ready'
        DB::statement("ALTER TABLE final_assignments MODIFY status ENUM('pending', 'accepted', 'rejected', 'certificate_ready') NOT NULL DEFAULT 'pending'");
    }

    public function down(): void
    {
        // Rollback (kembalikan ke ENUM tanpa nilai baru jika rollback diperlukan)
        DB::statement("ALTER TABLE final_assignments MODIFY status ENUM('pending', 'accepted', 'rejected') NOT NULL DEFAULT 'pending'");
    }
};
