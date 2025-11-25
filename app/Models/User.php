<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Filament\Models\Contracts\FilamentUser; // Pastikan ini ada
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Filament\Panel;

// PERBAIKAN DI SINI: Tambahkan "implements FilamentUser"
class User extends Authenticatable implements FilamentUser
{
    use HasFactory, Notifiable;
    use HasRoles;

    protected $fillable = [
        'name',
        'email',
        'identity_number',
        'password',
        'is_active',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'is_active' => 'boolean',
    ];

    public function canAccessPanel(Panel $panel): bool
    {
        // 1. Panel Admin (Pusat Manajemen)
        // Akses: Super Admin & Staff
        if ($panel->getId() === 'admin') {
            return $this->hasRole(['super_admin', 'staff']);
        }

        // 2. Panel Dosen (Akademik Pengajar)
        // Akses: Super Admin & Dosen
        if ($panel->getId() === 'dosen') {
            return $this->hasRole(['super_admin', 'dosen']);
        }

        // 3. Panel Musyrif (Kesantrian Asrama)
        // Akses: Super Admin & Musyrif
        if ($panel->getId() === 'musyrif') {
            return $this->hasRole(['super_admin', 'musyrif']);
        }

        // 4. Panel Santri (Portal Mahasantri/Pendaftar)
        // Akses: Santri (Aktif) & Pendaftar (Calon)
        // Catatan: Super Admin TIDAK masuk sini agar tidak mengotori data santri
        if ($panel->getId() === 'santri') {
            return $this->hasRole(['santri', 'pendaftar']);
        }

        // Default: Blokir akses ke panel lain yang tidak terdefinisi
        return false;
    }
}