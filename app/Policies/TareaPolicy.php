<?php

namespace App\Policies;

use App\Models\Tarea;
use App\Models\User;

class TareaPolicy
{
    /**
     * Cada usuario solo puede ver y gestionar sus propias tareas.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, Tarea $tarea): bool
    {
        return $tarea->usuario_id === $user->id;
    }

    public function create(User $user): bool
    {
        return true;
    }

    public function update(User $user, Tarea $tarea): bool
    {
        return $tarea->usuario_id === $user->id;
    }

    public function delete(User $user, Tarea $tarea): bool
    {
        return $tarea->usuario_id === $user->id;
    }

    public function restore(User $user, Tarea $tarea): bool
    {
        return $tarea->usuario_id === $user->id;
    }

    public function forceDelete(User $user, Tarea $tarea): bool
    {
        return $tarea->usuario_id === $user->id;
    }
}
