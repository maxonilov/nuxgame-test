<?php

namespace App\Http\Requests;

use App\Dto\User\RegisterDto;
use Illuminate\Foundation\Http\FormRequest;

/**
 * @property string $username
 * @property string $phone_number
 */
class RegisterRequest extends FormRequest
{
    /**
     * @return array[]
     */
    public function rules(): array
    {
        return [
            'username'     => ['required', 'string', 'max:255', 'unique:users'],
            'phone_number' => ['required', 'string', 'regex:/^\+?[\d\s\-\(\)]{7,20}$/', 'unique:users'],
        ];
    }

    /**
     * @return RegisterDto
     */
    public function toDto(): RegisterDto
    {
        return new RegisterDto(
            username: $this->username,
            phoneNumber: $this->phone_number,
        );
    }
}
