<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\User;

final class UserRepository
{
    public function getById(int $id): ?User
    {
        return User::query()->where('id', '=', $id)->first();
    }

    public function getByEmail(string $email): ?User
    {
        return User::query()->where('email', '=', $email)->first();
    }
}
