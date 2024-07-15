<?php

namespace Tests\Unit\Models;

use App\Models\Repository;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RepositoryTest extends TestCase
{

    use RefreshDatabase;

    /**
     * Check if repository has a user
     * @return void
     */
    public function test_belongs_to_user(): void
    {
        $repository = Repository::factory()->create();

        $this->assertInstanceOf(User::class, $repository->user);
    }
}
