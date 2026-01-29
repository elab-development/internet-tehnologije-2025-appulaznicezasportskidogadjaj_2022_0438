<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ulaznica extends Model
{

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
