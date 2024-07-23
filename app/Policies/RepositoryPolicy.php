<?php

namespace App\Policies;

use App\Models\Repository;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class RepositoryPolicy
{
    /**
     * Validate that auth user is the owner of the repository
     *
     * @param User       $user
     * @param Repository $repository
     *
     * @return Response
     */
    public function pass(User $user, Repository $repository): Response
    {
        return $user->id === $repository->user_id  ? Response::allow()
            : Response::denyWithStatus(403);
    }
}
