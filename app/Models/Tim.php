<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tim extends Model
{

    protected $table = 'timovi';

    protected $fillable = [
        'naziv',
        'grad',
    ];

    // Tim učestvuje na više događaja (pivot tabela)
    public function sportskiDogadjaji()
    {
        return $this->belongsToMany(
            SportskiDogadjaj::class,
            'ucesce_tima',
            'timId',
            'dogadjajId'
        )->withPivot('uloga');
    }

    public function ucesca()
    {
        return $this->hasMany(UcesceTima::class, 'timId');
    }
}
