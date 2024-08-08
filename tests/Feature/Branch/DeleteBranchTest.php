<?php

namespace Tests\Feature\Branch;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Branch;

class DeleteBranchTest extends TestCase
{
    use RefreshDatabase;

    public function test_authenticated_user_can_delete_branch()
    {
        // Create an admin user using the factory
        $user = User::factory()->admin()->create();

        // Create a branch using the factory
        $branch = Branch::factory()->create([
            'name' => 'Branch to be deleted',
            'address' => '123 Delete Street',
            'wa_token' => 'delete123',
        ]);

        // Send a DELETE request to the API endpoint
        $response = $this->actingAs($user)->deleteJson("/branches/{$branch->id}");

        // Assert that the response status is 204 (No Content)
        $response->assertStatus(204);

        // Assert that the branch has been soft deleted
        $this->assertSoftDeleted('branches', [
            'id' => $branch->id,
        ]);
    }
}

