<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class KategorijaUlaznicaResource extends JsonResource
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
            'tipSedista' => $this->tipSedista,
            'cena' => $this->cena,
            'kapacitet' => $this->kapacitet,

            'dogadjajId' => $this->dogadjajId,
            'dogadjaj' => $this->sportskiDogadjaj,
        ];
    }  
}
