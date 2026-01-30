<?php

namespace Database\Factories;

use App\Models\KategorijaUlaznica;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ulaznica>
 */
class UlaznicaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'kategorijaUlaznicaId' => KategorijaUlaznica::factory(),

            'korisnikId' => User::factory(),

            'status' => fake()->randomElement([
                'AKTIVNA',
                'ISKORISCENA',
                'OTKAZANA',
            ]),
            
            'qrKod' => (string) Str::uuid(),
        ];
    }
}
