<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        // Daftar Role Sesuai Grand Design
        $roles = [
            'super_admin', // Akses Penuh (Root)
            'admin',       // Staff Administrasi
            'dosen',       // Panel Akademik
            'musyrif',     // Panel Kesantrian
            'santri',      // Panel Santri (Frontend)
        ];

        foreach ($roles as $roleName) {
            Role::firstOrCreate(['name' => $roleName, 'guard_name' => 'web']);
        }
        
        $this->command->info('✅ 5 Role Utama Berhasil Dibuat!');
    }
}