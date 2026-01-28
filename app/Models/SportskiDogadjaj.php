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

    public function posetilac()
    {
        return $this->belongsTo(User::class, 'korisnikId');
    }

    public function kategorijeUlaznica()
    {
        return $this->hasMany(KategorijaUlaznica::class, 'dogadjajId');
    }

    public function timovi()
    {
        return $this->belongsToMany(
            Tim::class,
            'ucesce_tima',
            'dogadjajId',
            'timId'
        )->withPivot('uloga');
    }

    public function ucesca()
    {
        return $this->hasMany(UcesceTima::class, 'dogadjajId');
    }
}
