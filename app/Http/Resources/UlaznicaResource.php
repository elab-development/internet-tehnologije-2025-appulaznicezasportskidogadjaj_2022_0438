<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UlaznicaResource extends JsonResource
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
            'kategorijaUlaznicaId' => $this->kategorijaUlaznicaId,
            'kategorijaUlaznica' => $this->kategorija,
            'korisnikId' => $this->korisnikId,
            'korisnik' => $this->korisnik,
            'status' => $this->status,
            'qrKod' => $this->qrKod,
        ];
    }
}
