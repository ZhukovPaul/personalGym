<?php

declare(strict_types=1);

namespace App\Actions\Users;

use App\DTO\User\UserUpdateRequestDTO;
use App\Repositories\UserRepository;

final class UpdateUserProfileAction
{
    public function __construct(
        public UserRepository $userRepository
    ) {
    }

    public function __invoke(UserUpdateRequestDTO $data): void
    {
        $model = $this->userRepository->getById($data->id);

        if (! is_null($data->file)) {
            $model->clearMediaCollection('profile_photo')
                ->addMedia($data->file)
                ->toMediaCollection('profile_photo');
        }

        $model->update([
            'name' => $data->name,
            'lastname' => $data->lastName,
            'email' => $data->email,
            'birthday' => $data->birthday,
        ]);
    }
}
