<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\DTO\User\UserUpdateRequestDTO;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Carbon;

class UserUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'id' => 'required|integer',
            'name' => 'required|max:255',
            'lastname' => 'max:255',
            'birthday' => 'date',
            'file' => 'image',
            'email' => 'email',
        ];
    }

    public function getDTO(): UserUpdateRequestDTO
    {
        $response = $this->validated();

        return new UserUpdateRequestDTO(
            id: (int) $response['id'],
            name: $response['name'],
            lastName: $response['lastname'],
            birthday: Carbon::parse($response['birthday']),
            file: $this->file('user_image_id'),
            email: $response['email']
        );
    }
}
