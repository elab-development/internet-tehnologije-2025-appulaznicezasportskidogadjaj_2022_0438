<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SportskiDogadjaj extends Model
{
    protected $fillable = [
        'naziv',
        'opis',
        'lokacija',
        'datumVreme',
        'aktivan',
        'korisnikId',
    ];

    protected $casts = [
        'datumVreme' => 'datetime',
        'aktivan' => 'boolean',
    ];
}
