<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SportskiDogadjaj>
 */
class SportskiDogadjajFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'naziv' => fake()->sentence(3),
            'opis' => fake()->paragraph(),
            'lokacija' => fake()->city(),
            'datumVreme' => fake()->dateTimeBetween('+1 days', '+6 months'),
            'aktivan' => fake()->boolean(90), // 90% šanse da je aktivan
            'korisnikId' => User::factory(),
        ];
    }
}
