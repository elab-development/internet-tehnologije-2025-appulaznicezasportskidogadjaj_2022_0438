<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KategorijaUlaznica extends Model
{
    protected $fillable = [
        'dogadjajId',
        'naziv',
        'tipSedista',
        'cena',
        'kapacitet',
    ];
}
