<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KategorijaUlaznica extends Model
{

    protected $table = 'kategorijeulaznica';
    protected $fillable = [
        'dogadjajId',
        'naziv',
        'tipSedista',
        'cena',
        'kapacitet',
    ];

    public function sportskiDogadjaj()
    {
        return $this->belongsTo(SportskiDogadjaj::class, 'dogadjajId');
    }

    public function ulaznice()
    {
        return $this->hasMany(Ulaznica::class, 'kategorijaUlaznicaId');
    }
}
