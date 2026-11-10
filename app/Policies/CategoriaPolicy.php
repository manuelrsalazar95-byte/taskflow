<?php

namespace App\Policies;

use App\Models\Categoria;
use App\Models\User;

class CategoriaPolicy
{
    /**
     * Las categorías son privadas: solo su propietario puede gestionarlas.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, Categoria $categoria): bool
    {
        return $categoria->user_id === $user->id;
    }

    public function create(User $user): bool
    {
        return true;
    }

    public function update(User $user, Categoria $categoria): bool
    {
        return $categoria->user_id === $user->id;
    }

    public function delete(User $user, Categoria $categoria): bool
    {
        return $categoria->user_id === $user->id;
    }
}
