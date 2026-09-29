<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Registrasi jemaat memakai nomor WhatsApp.
            $table->string('email')->nullable()->change();

            // Nullable supaya akun lama tetap dapat dipertahankan.
            $table->string('phone', 20)->nullable()->unique();
            $table->timestamp('phone_verified_at')->nullable();
            $table->string('role', 30)->default('jemaat');
        });
    }

    public function down(): void
    {
        // Hindari mengembalikan email menjadi wajib
        // ketika ada akun yang belum memiliki email.
        if (DB::table('users')->whereNull('email')->exists()) {
            throw new RuntimeException(
                'Rollback dibatalkan: masih ada akun tanpa email.'
            );
        }

        Schema::table('users', function (Blueprint $table) {
            $table->dropUnique(['phone']);

            $table->dropColumn([
                'phone',
                'phone_verified_at',
                'role',
            ]);

            $table->string('email')->nullable(false)->change();
        });
    }
};