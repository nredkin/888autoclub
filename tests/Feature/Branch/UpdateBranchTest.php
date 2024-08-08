<?php

namespace Tests\Feature\Branch;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Branch;

class UpdateBranchTest extends TestCase
{
    use RefreshDatabase;

    public function test_authenticated_user_can_update_branch()
    {
        // Create an admin user using the factory
        $user = User::factory()->admin()->create();

        // Create a branch using the factory
        $branch = Branch::factory()->create([
            'name' => 'Old Branch',
            'address' => '456 Old Street',
            'wa_token' => 'oldtoken123',
        ]);

        // Send a PUT request to update the branch
        $response = $this->actingAs($user)->putJson("/branches/{$branch->id}", [
            'name' => 'Updated Branch',
            'address' => '789 Updated Street',
            'wa_token' => 'newtoken456',
        ]);

        // Assert that the response status is 200 (OK)
        $response->assertStatus(200)
            ->assertJson([
                'branch' => [
                    'id' => $branch->id,
                    'name' => 'Updated Branch',
                    'address' => '789 Updated Street',
                    'wa_token' => 'newtoken456',
                ]
            ]);

        // Assert that the branch was updated in the database
        $this->assertDatabaseHas('branches', [
            'id' => $branch->id,
            'name' => 'Updated Branch',
            'address' => '789 Updated Street',
            'wa_token' => 'newtoken456',
        ]);
    }
}

