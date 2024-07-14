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
        if (app()->environment() === 'local') {
            $this->createUserWithEmployee('admin@test.dev', User::ROLE_ADMIN, 'Admin', 'User');
            $this->createUserWithEmployee('manager@test.dev', User::ROLE_MANAGER, 'Manager', 'User');
        }
    }

    /**
     * Create a user with associated employee record.
     */
    private function createUserWithEmployee(string $email, int $roleId, string $firstName, string $lastName): void
    {
        DB::transaction(function () use ($email, $roleId, $firstName, $lastName) {
            $user = User::where('email', $email)->first();

            if (!$user) {
                $employee = Employee::create([
                    'first_name' => $firstName,
                    'last_name' => $lastName,
                    // Add other necessary employee fields here
                    // For example: 'branch_id' => 1,
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
}
