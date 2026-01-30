<?php

namespace Database\Seeders;

use App\Models\KategorijaUlaznica;
use App\Models\SportskiDogadjaj;
use App\Models\Tim;
use App\Models\UcesceTima;
use App\Models\Ulaznica;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create();
        Tim::factory(30)->create();

        SportskiDogadjaj::factory(15)->create();
        KategorijaUlaznica::factory(20)->create();

        UcesceTima::factory(70)->create();
        Ulaznica::factory(50)->create();
    }
}
