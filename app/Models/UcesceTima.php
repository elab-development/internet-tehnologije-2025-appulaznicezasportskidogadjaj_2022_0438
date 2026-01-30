<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UcesceTima extends Model
{
    use HasFactory;
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
