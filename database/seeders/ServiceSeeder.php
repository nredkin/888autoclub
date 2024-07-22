<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    public function run()
    {
        $services = [
            [
                'name' => 'Посуточная оплата от 1 до 2 суток',
                'photo' => null,
                'unit' => null,
                'with_driver' => false,
                'uniform_cost_for_cards' => false,
                'is_active' => true,
                'available_from_hours' => null,
                'available_to_hours' => null,
                'invoice_name' => null,
                'is_collect' => false,
            ],
            [
                'name' => 'Посуточная оплата от 3 до 7 суток',
                'photo' => null,
                'unit' => null,
                'with_driver' => false,
                'uniform_cost_for_cards' => false,
                'is_active' => true,
                'available_from_hours' => null,
                'available_to_hours' => null,
                'invoice_name' => null,
                'is_collect' => false,
            ],
            [
                'name' => '1 км сверх лимита',
                'photo' => null,
                'unit' => null,
                'with_driver' => false,
                'uniform_cost_for_cards' => false,
                'is_active' => true,
                'available_from_hours' => null,
                'available_to_hours' => null,
                'invoice_name' => null,
                'is_collect' => false,
            ],
        ];

        foreach ($services as $service) {
            Service::create($service);
        }
    }
}
