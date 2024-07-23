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
     * Test if index without repos
     * @return void
     */
    public function test_index_empty()
    {
        $this->withoutExceptionHandling();
        Repository::factory()->create();
        $user = User::factory()->create();

        $this->actingAs($user)
            ->get('repositories')
            ->assertStatus(200)
            ->assertSee('No hay repositorios');

    }

    /**
     * Test index with all repositories by user
     * @return void
     */
    public function test_index()
    {
        $user = User::factory()->create();
        $repository = Repository::factory()->create(['user_id' => $user->id]);

        $this->actingAs($user)
            ->get('repositories')
            ->assertStatus(200)
            ->assertSee($repository->id)
            ->assertSee($repository->url);
    }

    /**
     * Test if shows a non-user repository
     * @return void
     */
    public function test_show_policy()
    {
        $user = User::factory()->create();
        $repository = Repository::factory()->create();

        $this->actingAs($user)
            ->get("repositories/$repository->id")
            ->assertStatus(403);
    }

    /**
     * Test if repository not exists
     * @return void
     */
    public function test_show_not_found()
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->get("repositories/1000")
            ->assertStatus(404);
    }

    /**
     * Test if shows a repository
     * @return void
     */
    public function test_show()
    {
        $user = User::factory()->create();
        $repository = Repository::factory()->create(['user_id' => $user->id]);

        $this->actingAs($user)
            ->get("repositories/$repository->id")
            ->assertStatus(200)
            ->assertSee($repository->id);

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
            ->assertStatus(302)
            ->assertSessionHasErrors(['url', 'description']);

    }

    /**
     * Test create view
     * @return void
     */
    public function test_create()
    {
        $this->withoutExceptionHandling();
        $user = User::factory()->create();

        $this->actingAs($user)
            ->get('repositories/create')
            ->assertStatus(200);
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
     * Test if repository not exists
     * @return void
     */
    public function test_edit_not_found()
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->get("repositories/10000/edit")
            ->assertStatus(404);
    }

    /**
     * Test edit form
     * @return void
     */
    public function test_edit_policy()
    {
        $user = User::factory()->create();
        $repository = Repository::factory()->create();

        $this->actingAs($user)
            ->get("repositories/$repository->id/edit")
            ->assertStatus(403);

    }

    /**
     * Test if can edit repository
     * @return void
     */
    public function test_edit()
    {
//        $this->withoutExceptionHandling();
        $user = User::factory()->create();
        $repository = Repository::factory()->create(['user_id' => $user->id]);

        $this->actingAs($user)
            ->get("repositories/$repository->id/edit")
            ->assertStatus(200)
            ->assertSee($repository->url)
            ->assertSee($repository->description);

    }

    /**
     * Test access policies to update a repo.
     * @return void
     */
    public function test_update_policy()
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
            ->assertStatus(403);
    }

    /**
     * Test if request validator works (all data empty)
     * @return void
     */
    public function test_validate_empty_request_put()
    {
        $user = User::factory()->create();
        $repository = Repository::factory()->create(['user_id' => $user->id]);

        $this->actingAs($user)
            ->put("repositories/$repository->id", [])
            ->assertStatus(302)
            ->assertSessionHasErrors(['user_id', 'url', 'description']);
    }

    /**
     * Test if put repository
     * @return void
     */
    public function test_put_update()
    {
        $user = User::factory()->create();
        $repository = Repository::factory()->create(['user_id' => $user->id]);
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
        $repository = Repository::factory()->create(['user_id' => $user->id]);
        $data = [
            'url' => $this->faker->url,
            'description' => $this->faker->text,
        ];

        $this->actingAs($user)
            ->patch("repositories/$repository->id", $data)
            ->assertRedirect("repositories/$repository->id/edit");
        $this->assertDatabaseHas('repositories', $data);
    }

    public function test_destroy_policy()
    {
        $user = User::factory()->create();
        $repository = Repository::factory()->create();

        $this->actingAs($user)
            ->delete("repositories/$repository->id")
            ->assertStatus(403);
    }

    public function test_destroy()
    {
//        $this->withoutExceptionHandling();
        $user = User::factory()->create();
        $repository = Repository::factory()->create(['user_id' => $user->id]);

        $this->actingAs($user)
            ->delete("repositories/$repository->id")
            ->assertRedirect("repositories");
        $this->assertDatabaseMissing("repositories", [
            'id' =>$repository->id
        ]);

    }

}
