<?php

namespace App\Policies;

use App\Models\User;
use App\Enums\UserRole;

class RolePolicy
{
    public function isAdmin(User $user): bool
    {
        return $user->role === UserRole::ADMIN->value;
    }

    public function isModerator(User $user): bool
    {
        return $user->role === UserRole::MODERATOR->value;
    }

    public function isUser(User $user): bool
    {
        return $user->role === UserRole::USER->value;
    }

    public function isAdminOrModerator(User $user): bool
    {
        return in_array($user->role, [UserRole::ADMIN->value, UserRole::MODERATOR->value]);
    }

    public function isModeratorOrUser(User $user): bool
    {
        return in_array($user->role, [UserRole::MODERATOR->value, UserRole::USER->value]);
    }
}
