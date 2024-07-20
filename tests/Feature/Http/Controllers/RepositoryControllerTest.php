<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Repository;
use App\Models\User;
use Database\Factories\UserFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RepositoryControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /**
     * Test if all routes are protected by auth middleware
     * @return void
     */
    public function test_guest(): void
    {
        $this->get('repositories')->assertRedirect('login');
        $this->post('repositories', [])->assertRedirect('login');
        $this->get('repositories/create')->assertRedirect('login');
        $this->get('repositories/1')->assertRedirect('login');
        $this->get('repositories/1/edit')->assertRedirect('login');
        $this->put('repositories/1')->assertRedirect('login');
        $this->delete('repositories/1')->assertRedirect('login');

    }

    /**
     * Test if request validator works (all data empty)
     * @return void
     */
    public function test_validate_empty_request_store()
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->post('repositories', [])
            ->assertSessionHasErrors(['url', 'description']);

    }

    /**
     * Test if repository is saved
     * @return void
     */
    public function test_store()
    {
        $data = [
            'url' => $this->faker->url,
            'description' => $this->faker->text,
        ];
        $user = User::factory()->create();

        $this->actingAs($user)
            ->post('repositories', $data)
            ->assertRedirect('repositories');
        $this->assertDatabaseHas('repositories', $data);
    }

    /**
     * Test if request validator works (all data empty)
     * @return void
     */
    public function test_validate_empty_request_put()
    {
        $user = User::factory()->create();
        $repository = Repository::factory()->create();

        $this->actingAs($user)
            ->put("repositories/$repository->id", [])
            ->assertSessionHasErrors(['user_id', 'url', 'description']);
    }

    /**
     * Test if put repository
     * @return void
     */
    public function test_put_update()
    {
        $user = User::factory()->create();
        $repository = Repository::factory()->create();
        $data = [
            'user_id' => $repository->user_id,
            'url' => $this->faker->url,
            'description' => $this->faker->text,
        ];

        $this->actingAs($user)
            ->put("repositories/$repository->id", $data)
            ->assertRedirect("repositories/$repository->id/edit");
        $this->assertDatabaseHas('repositories', $data);
    }

    /**
     * Test if patch repository
     * @return void
     */
    public function test_patch_update()
    {
        $user = User::factory()->create();
        $repository = Repository::factory()->create();
        $data = [
            'url' => $this->faker->url,
            'description' => $this->faker->text,
        ];

        $this->actingAs($user)
            ->patch("repositories/$repository->id", $data)
            ->assertRedirect("repositories/$repository->id/edit");
        $this->assertDatabaseHas('repositories', $data);
    }


}
