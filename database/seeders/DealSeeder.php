<?php

namespace Database\Seeders;

use App\Models\Branch;
use App\Models\Car;
use App\Models\Deal;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class DealSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $faker = Faker::create();
        $clients = User::where('role_id', User::ROLE_CLIENT)->get();
        $cars = Car::all();
        $branches = Branch::all();

        foreach ($clients as $client) {
            $numberOfDeals = $faker->numberBetween(1, 3);

            for ($i = 0; $i < $numberOfDeals; $i++) {
                Deal::create([
                    'deal_type' => $faker->numberBetween(0, 1),
                    'user_id' => $client->id,
                    'car_id' => $cars->random()->id,
                    'branch_id' => $branches->random()->id,
                    'security_deposit' => $faker->randomFloat(2, 10000, 50000),
                    'contract_date' => $faker->date(),
                    'rental_start' => $faker->dateTimeBetween('-1 month', '+1 month'),
                    'rental_end' => $faker->dateTimeBetween('+1 month', '+2 months'),
                    'comment' => $faker->optional()->text,
                ]);
            }
        }
    }
}
