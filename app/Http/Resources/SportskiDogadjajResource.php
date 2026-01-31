<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SportskiDogadjajResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'naziv' => $this->naziv,
            'opis' => $this->opis,
            'lokacija' => $this->lokacija,
            'datumVreme' => $this->datumVreme ? $this->datumVreme->format('d-m-Y') : null,
            'aktivan' => (bool) $this->aktivan,
            'korisnikId' => $this->korisnikId,
            'korisnik' => $this->posetilac,
        ];
    }
}
