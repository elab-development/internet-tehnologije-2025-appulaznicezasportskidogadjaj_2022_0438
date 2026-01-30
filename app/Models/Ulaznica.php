<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ulaznica extends Model
{
    use HasFactory;
    protected $table = 'ulaznice';

    protected $fillable = [
        'kategorijaUlaznicaId',
        'korisnikId',
        'status',
        'qrKod',
    ];

      public function kategorija()
    {
        return $this->belongsTo(KategorijaUlaznica::class, 'kategorijaUlaznicaId');
    }

    public function korisnik()
    {
        return $this->belongsTo(User::class, 'korisnikId');
    }
}
