<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Client;
use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition()
    {
        return [
            'email' => $this->faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => bcrypt('password'), // default password
            'role_id' => User::ROLE_CLIENT, // default role is client
            'userable_id' => null, // to be set dynamically
            'userable_type' => null, // to be set dynamically
            'is_active' => true,
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the user is an admin.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function admin()
    {
        return $this->state(function (array $attributes) {
            return [
                'role_id' => User::ROLE_ADMIN,
                'userable_id' => Employee::factory(),
                'userable_type' => Employee::class,
            ];
        });
    }

    /**
     * Indicate that the user is a manager.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function manager()
    {
        return $this->state(function (array $attributes) {
            return [
                'role_id' => User::ROLE_MANAGER,
                'userable_id' => Employee::factory(),
                'userable_type' => Employee::class,
            ];
        });
    }

    /**
     * Indicate that the user is a client.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function client()
    {
        return $this->state(function (array $attributes) {
            return [
                'role_id' => User::ROLE_CLIENT,
                'userable_id' => Client::factory(),
                'userable_type' => Client::class,
            ];
        });
    }
}

