<?php

namespace Database\Seeders;

use App\Models\ClubCardLevel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClubCardLevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $levels = [
            ['name' => '888 club'],
            ['name' => '888 club silver'],
            ['name' => '888 club gold'],
            ['name' => '888 club elite'],
        ];

        foreach ($levels as $level) {
            ClubCardLevel::create($level);
        }
    }
}
