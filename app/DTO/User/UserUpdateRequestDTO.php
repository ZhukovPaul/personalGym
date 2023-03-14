<?php

declare(strict_types=1);

namespace App\DTO\User;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Carbon;

final class UserUpdateRequestDTO
{
    public function __construct(
        public readonly int $id,
        public readonly string $name,
        public readonly ?string $lastName,
        public readonly ?Carbon $birthday,
        public readonly ?UploadedFile $file,
        public readonly string $email,
    ) {
    }
}
