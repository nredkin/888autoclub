<?php

namespace Database\Seeders;

use App\Models\Employee;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            BranchSeeder::class,
            UserSeeder::class,
            ColorSeeder::class,
            ClubCardLevelSeeder::class,
            CarSeeder::class,
            DealSeeder::class,
            ServiceSeeder::class,
            ServicePriceSeeder::class,
        ]);

    }


}
