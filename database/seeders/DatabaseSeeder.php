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
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        //Ovo spada u naprednije zahteve kao i mozes kroz konzolu onom komandom: php artisan migrate:fresh --seed
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Ulaznica::truncate();
        UcesceTima::truncate();
        KategorijaUlaznica::truncate();
        SportskiDogadjaj::truncate();
        Tim::truncate();
        User::truncate();

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        User::factory(10)->create();
        Tim::factory(30)->create();

        SportskiDogadjaj::factory(15)->create();
        KategorijaUlaznica::factory(20)->create();

        UcesceTima::factory(70)->create();
        Ulaznica::factory(50)->create();
    }
}
