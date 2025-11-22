<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    // ¿Quién puede ver la lista de usuarios? (Admin y Supervisor)
    public function viewAny(User $user): bool
    {
        return $user->isAdmin() || $user->isSupervisor();
    }

    // ¿Quién puede ver detalles sensibles (IP, logs)? (Solo Admin)
    public function viewSensitiveData(User $user): bool
    {
        return $user->isAdmin();
    }

    // ¿Quién puede crear usuarios? (Solo Admin)
    public function create(User $user): bool
    {
        return $user->isAdmin();
    }

    // ¿Quién puede editar otros usuarios (cambiar rol, bloquear)? (Solo Admin)
    public function update(User $user, User $model): bool
    {
        return $user->isAdmin();
    }

    // ¿Quién puede borrar usuarios? (Solo Admin)
    public function delete(User $user, User $model): bool
    {
        return $user->isAdmin();
    }
}