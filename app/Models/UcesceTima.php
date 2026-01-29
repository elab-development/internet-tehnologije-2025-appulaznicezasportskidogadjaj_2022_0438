<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UcesceTima extends Model
{

    protected $table = 'ucescatimova';

    protected $fillable = [
        'dogadjajId',
        'timId',
        'uloga',
    ];

    public function sportskiDogadjaj()
    {
        return $this->belongsTo(SportskiDogadjaj::class, 'dogadjajId');
    }

    public function tim()
    {
        return $this->belongsTo(Tim::class, 'timId');
    }
}
