<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ulaznica extends Model
{
    protected $fillable = [
        'kategorijaUlaznicaId',
        'korisnikId',
        'status',
        'qrKod',
    ];
}
