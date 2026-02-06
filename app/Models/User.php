<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'ime',
        'prezime',
        'email',
        'password',
        'role',
    ];

    protected $casts = [
        'kreiranAt' => 'datetime',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Korisnik poseduje više sportskih događaja
    public function sportskiDogadjaji()
    {
        return $this->hasMany(SportskiDogadjaj::class, 'korisnikId');
    }

    // Korisnik poseduje više ulaznica
    public function ulaznice()
    {
        return $this->hasMany(Ulaznica::class, 'korisnikId');
    }

    // provera uloga
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function isModerator(): bool
    {
        return $this->role === 'moderator';
    }

    public function isKorisnik(): bool
    {
        return $this->role === 'korisnik';
    }

    // Dozvole (Permissions)
    public function canCreateEvent(): bool
    {
        return $this->isAdmin();
    }

    public function canEditEvent(): bool
    {
        return $this->isAdmin() || $this->isModerator();
    }

    public function canDeleteEvent(): bool
    {
        return $this->isAdmin();
    }
}
