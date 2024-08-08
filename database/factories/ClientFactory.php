<?php

namespace Database\Factories;

use App\Models\Client;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClientFactory extends Factory
{
    protected $model = Client::class;

    public function definition()
    {
        return [
            'first_name' => $this->faker->firstName(),
            'middle_name' => $this->faker->lastName(),
            'last_name' => $this->faker->lastName(),
            'phone_number' => $this->faker->unique()->phoneNumber(),
            'balance' => $this->faker->randomFloat(2, 0, 1000),
            'bonus_points' => $this->faker->numberBetween(0, 1000),
            'birthday' => $this->faker->date(),
            'passport_series' => $this->faker->regexify('[A-Z0-9]{4}'),
            'passport_number' => $this->faker->regexify('[0-9]{6}'),
            'passport_notes' => $this->faker->sentence(),
            'passport_issue_date' => $this->faker->date(),
            'inn' => $this->faker->regexify('[0-9]{12}'),
            'registration_address' => $this->faker->address(),
            'complaints' => $this->faker->paragraph(),
            'last_check_fssp' => $this->faker->date(),
            'last_check_enforcement' => $this->faker->date(),
            'comment' => $this->faker->sentence(),
        ];
    }
}

