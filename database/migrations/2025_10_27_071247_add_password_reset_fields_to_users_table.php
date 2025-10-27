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
        Schema::table('users', function (Blueprint $table) {
            // Kolom untuk menyimpan password baru yang diminta (di-hash)
            $table->string('requested_password')->nullable();
            
            // Kolom untuk status permintaan ganti password (pending, accepted, rejected)
            $table->enum('password_reset_status', ['pending', 'accepted', 'rejected'])->default('pending');
            
            // Kolom untuk token reset (opsional, tapi berguna untuk konfirmasi)
            $table->string('password_reset_token')->nullable()->unique(); 
            
            // Kolom untuk waktu kadaluarsa token
            $table->timestamp('password_reset_expires_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['requested_password', 'password_reset_status', 'password_reset_token', 'password_reset_expires_at']);
        });
    }
};