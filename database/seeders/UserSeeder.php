<?php

namespace Database\Seeders;

use App\Models\Branch;
use App\Models\Client;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->createUserWithEmployee('admin@test.dev', User::ROLE_ADMIN, 'Admin', 'User');
        $this->createUserWithEmployee('manager@test.dev', User::ROLE_MANAGER, 'Manager', 'User');
        $this->createUserWithClient('client1@test.dev', User::ROLE_CLIENT);
        $this->createUserWithClient('client2@test.dev', User::ROLE_CLIENT);
    }

    /**
     * Create a user with associated employee record.
     */
    private function createUserWithEmployee(string $email, int $roleId, string $firstName, string $lastName): void
    {
        DB::transaction(function () use ($email, $roleId, $firstName, $lastName) {
            $user = User::where('email', $email)->first();

            if (!$user) {
                $firstBranch = Branch::first();

                $employee = Employee::create([
                    'first_name' => $firstName,
                    'last_name' => $lastName,
                    'branch_id' => $firstBranch->id,
                ]);

                $user = User::create([
                    'email' => $email,
                    'role_id' => $roleId,
                    'is_active' => true,
                    'password' => Hash::make('pass54321'),
                    'userable_id' => $employee->id,
                    'userable_type' => Employee::class,
                ]);

                $employee->user()->save($user);
            }
        });
    }

    /**
     * Create a user with associated client record.
     */
    private function createUserWithClient(string $email, int $roleId): void
    {
        DB::transaction(function () use ($email, $roleId) {
            $user = User::where('email', $email)->first();

            if (!$user) {
                $faker = Faker::create();

                $client = Client::create([
                    'first_name' => $faker->firstName,
                    'middle_name' => $faker->optional()->firstName,
                    'last_name' => $faker->lastName,
                    'phone_number' => $faker->optional()->phoneNumber,
                    'birthday' => $faker->optional()->date,
                    'passport_series' => $faker->optional()->regexify('[A-Z]{2}'),
                    'passport_number' => $faker->optional()->regexify('[0-9]{6}'),
                    'passport_notes' => $faker->optional()->sentence,
                    'passport_issue_date' => $faker->optional()->date,
                    'inn' => $faker->optional()->regexify('[0-9]{12}'),
                    'registration_address' => $faker->optional()->address,
                    'complaints' => $faker->optional()->text,
                    'last_check_fssp' => $faker->optional()->date,
                    'last_check_enforcement' => $faker->optional()->date,
                    'balance' => $faker->randomFloat(2, 0, 10000),
                    'bonus_points' => $faker->numberBetween(0, 1000),
                    'comment' => $faker->optional()->text,
                ]);

                $user = User::create([
                    'email' => $email,
                    'role_id' => $roleId,
                    'is_active' => true,
                    'password' => Hash::make('pass54321'),
                    'userable_id' => $client->id,
                    'userable_type' => Client::class,
                ]);

                $client->user()->save($user);
            }
        });
    }
}
