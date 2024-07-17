<?php
namespace Database\Seeders;

use App\Models\Branch;
use App\Models\Car;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class CarSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        for ($i = 0; $i < 3; $i++) {
            Car::create([
                'model' => $faker->word(),
                'vin' => $faker->randomNumber(8),
                'year' => $faker->numberBetween(2010, 2023),
                'engine_model' => $faker->word(),
                'engine_power' => $faker->numberBetween(100, 500) . ' hp',
                'color_id' => rand(1, 10),
                'cost' => $faker->randomFloat(2, 10000, 100000),
                'branch_id' => 1,
                'registration_series' => $faker->word(),
                'registration_number' => $faker->randomNumber(6),
                'pts_number' => $faker->randomLetter() . $faker->randomNumber(7),
                'pts_date' => $faker->dateTimeBetween('-1 year'),
                'reg_sign' => $faker->word(),
                'description' => $faker->paragraph(),
            ]);
        }
    }
}
