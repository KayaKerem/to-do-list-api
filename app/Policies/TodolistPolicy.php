<?php

namespace App\Policies;

use App\Models\Todolist;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TodolistPolicy
{
    use HandlesAuthorization;

    public function view(User $user, Todolist $todolist): bool
    {
        return $todolist->user_id == $user->id;
    }

    public function create(User $user): bool
    {
        return true;
    }

    public function update(User $user, Todolist $todolist): bool
    {
        return $todolist->user_id == $user->id;
    }

    public function delete(User $user, Todolist $todolist): bool
    {
        return $todolist->user_id == $user->id;
    }
}
