<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

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
                'REZERVISANA',
                'PRODATA',
                'OTKAZANA',
                'ISKORISCENA',
            ]),
            
            'qrKod' => (string) Str::uuid(),
        ];
    }
}
