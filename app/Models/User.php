<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Filament\Models\Contracts\FilamentUser; // Pastikan ini ada
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use BezhanSalleh\FilamentShield\Traits\HasPanelShield;
use Spatie\Permission\Traits\HasRoles;
use Filament\Panel;

// PERBAIKAN DI SINI: Tambahkan "implements FilamentUser"
class User extends Authenticatable implements FilamentUser
{
    use HasFactory, Notifiable;
    use HasRoles;
    use HasPanelShield;

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
        if ($panel->getId() === 'admin') {
            // PERBAIKAN: Gunakan 'admin' bukan 'staff' sesuai RoleSeeder
            return $this->hasRole(['super_admin', 'admin']);
        }

        // 2. Panel Dosen
        if ($panel->getId() === 'dosen') {
            return $this->hasRole(['super_admin', 'dosen']);
        }

        // 3. Panel Musyrif
        if ($panel->getId() === 'musyrif') {
            return $this->hasRole(['super_admin', 'musyrif']);
        }

        // 4. Panel Santri
        if ($panel->getId() === 'santri') {
            // PERBAIKAN: Hapus 'pendaftar' dulu karena role belum dibuat di seeder
            return $this->hasRole(['santri']);
        }

        return false;
    }
}