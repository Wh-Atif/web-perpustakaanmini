<?php

namespace App\Policies;

use Illuminate\Auth\Access\Response;
use App\Models\Borrowing;
use App\Models\User;

class BorrowingPolicy
{

    public function before(User $user, string $ability)
    {
        if ($user->role === 'admin') {
            return true;
        }
    }

    /**
     * Determine whether the user can view anything of the model.
     */
    public function viewAny(User $user)
    {
        return $user->role === 'admin';
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Borrowing $borrowing): bool
    {
        return $user->id === $borrowing->user_id;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Borrowing $borrowing): bool
    {
        return $user->id === $borrowing->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Borrowing $borrowing): bool
    {
        return $user->id === $borrowing->user_id;
    }
}
