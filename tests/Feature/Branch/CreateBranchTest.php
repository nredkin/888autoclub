<?php

namespace Tests\Feature\Branch;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Branch;

class CreateBranchTest extends TestCase
{
    use RefreshDatabase;

    public function test_authenticated_user_can_create_branch()
    {
        // Create an admin user using the factory
        $user = User::factory()->admin()->create();

        // Create a branch via the API endpoint
        $response = $this->actingAs($user)->postJson('/branches', [
            'name' => 'New Branch',
            'address' => '123 New Street',
            'wa_token' => 'token123',
        ]);

        // Assert that the response is correct
        $response->assertStatus(201)
            ->assertJson([
                'branch' => [
                    'name' => 'New Branch',
                    'address' => '123 New Street',
                    'wa_token' => 'token123',
                ]
            ]);

        // Assert that the branch was created in the database
        $this->assertDatabaseHas('branches', [
            'name' => 'New Branch',
            'address' => '123 New Street',
            'wa_token' => 'token123',
        ]);
    }
}

