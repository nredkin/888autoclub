<?php
namespace Database\Seeders;

use App\Models\Color;
use Illuminate\Database\Seeder;

class ColorSeeder extends Seeder
{
    public function run()
    {
        $colors = [
            'красный',
            'синий',
            'зеленый',
            'белый',
            'чёрный',
            'серый',
            'розовый',
            'золотой',
            'фиолетовый',
            'коричневый'
        ];

        foreach ($colors as $color) {
            Color::create(['name' => $color]);
        }
    }
}
