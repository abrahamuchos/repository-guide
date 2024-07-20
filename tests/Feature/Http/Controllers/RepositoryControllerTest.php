<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\User;
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
        $prepareStore = $this->_prepareStore(false);

        $this->actingAs($prepareStore['user'])
            ->post('repositories', $prepareStore['data'])
            ->assertSessionHasErrors(['url', 'description']);

    }

    /**
     * Test if repository is saved
     * @return void
     */
    public function test_store()
    {
        $prepareStore = $this->_prepareStore();

        $this->actingAs($prepareStore['user'])
            ->post('repositories', $prepareStore['data'])
            ->assertRedirect('repositories');
        $this->assertDatabaseHas('repositories', $prepareStore['data']);
    }

    /**
     * Prepare data to store new repository
     *
     * @param bool $withData
     *
     * @return array
     */
    private function _prepareStore(bool $withData = true): array
    {
        if($withData){
            $data = [
                'url' => $this->faker->url,
                'description' => $this->faker->text,
            ];
        }else{
            $data = [
                'url' => null,
                'description' => null,
            ];
        }

        $user = User::factory()->create();

        return [
            'user' => $user,
            'data' => $data
        ];
    }

}
