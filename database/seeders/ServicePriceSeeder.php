<?php

namespace Database\Seeders;

use App\Models\Car;
use App\Models\ClubCardLevel;
use App\Models\Service;
use App\Models\ServicePrice;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class ServicePriceSeeder extends Seeder
{
    public function run()
    {
        $services = Service::all();
        $cars = Car::all();
        $clubCardLevels = ClubCardLevel::all();

        foreach ($services as $service) {
            foreach ($cars as $car) {
                ServicePrice::create([
                    'service_id' => $service->id,
                    'car_id' => $car->id,
                    'club_card_level_id' => null,
                    'price' => rand(100, 1000),
                ]);
                foreach ($clubCardLevels as $clubCardLevel) {
                    ServicePrice::create([
                        'service_id' => $service->id,
                        'car_id' => $car->id,
                        'club_card_level_id' => $clubCardLevel->id,
                        'price' => rand(100, 1000),
                    ]);
                }
            }
        }
    }
}
