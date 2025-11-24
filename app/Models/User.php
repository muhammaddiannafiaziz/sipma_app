<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail; // (Opsional, bawaan Laravel)
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles; // TAMBAHKAN INI (1)

class User extends Authenticatable
{
    use HasFactory, Notifiable;
    use HasRoles; // TAMBAHKAN INI (2)

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'identity_number', // Pastikan kolom baru kita juga ada di sini
        'password',
        'is_active',       // Pastikan kolom baru kita juga ada di sini
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'is_active' => 'boolean',
    ];
}