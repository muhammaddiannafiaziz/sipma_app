<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // 1. Kolom Identitas (NIM untuk Santri, NIP untuk Dosen)
            // Kita buat unique agar tidak ada 2 akun dengan NIM sama
            // Kita buat nullable agar Admin/Superuser tidak wajib punya NIM
            $table->string('identity_number')->unique()->nullable()->after('email');


            // 2. Kolom Status Aktif (Untuk fitur Banned/Blokir User)
            // Default true (aktif). Jika false, user tidak bisa login.
            $table->boolean('is_active')->default(true)->after('password');
           
            // 3. Soft Deletes (Opsional: Agar data tidak langsung hilang permanen saat dihapus)
            $table->softDeletes();
        });
    }


    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropSoftDeletes();
            $table->dropColumn(['identity_number', 'is_active']);
        });
    }
};

