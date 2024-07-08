<?php

namespace App\Http\Requests\User;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->user()->isAdmin();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'roleId'              => 'required|numeric',
            'first_name'          => 'required_if:role_id,' . User::ROLE_ADMIN . ',' . User::ROLE_MANAGER . '|string|max:255',
            'last_name'           => 'required_if:role_id,' . User::ROLE_ADMIN . ',' . User::ROLE_MANAGER . '|string|max:255',
            'middle_name'         => 'nullable|string|max:255',
            'branch_id'           => 'required_if:role_id,' . User::ROLE_ADMIN . ',' . User::ROLE_MANAGER . '|exists:branches,id',
        ];
    }

    public function messages(): array
    {
        return [
            'email.required'               => 'Поле "Email" должно быть заполнено',
            'email.email'                  => 'Поле "Email" должно быть адресом электронной почты',
            'email.unique'                 => 'Поле "Email" должно быть уникальным',
            'password.required'            => 'Поле "Пароль" должно быть заполнено',
            'password.min'                 => 'Поле "Пароль" должно быть не короче 6 символов',
        ];
    }

    public function getEmail(): string
    {
        return $this->input('email');
    }

    public function getPassword(): ?string
    {
        return $this->input('password');
    }

    public function getRoleId(): int
    {
        return $this->input('roleId');
    }
    public function isActive(): bool
    {
        return (bool)$this->input('is_active');
    }

    public function getFirstName(): string
    {
        $userable = $this->input('userable');
        return isset($userable['firstName']) ? $userable['firstName'] : '';
    }

    public function getMiddleName(): string
    {
        $userable = $this->input('userable');
        return isset($userable['middleName']) ? $userable['middleName'] : '';
    }

    public function getLastName(): string
    {
        $userable = $this->input('userable');
        return isset($userable['lastName']) ? $userable['lastName'] : '';
    }

    public function getBranchId(): int
    {
        $userable = $this->input('userable');
        return isset($userable['branchId']) ? $userable['branchId'] : 0;
    }

    public function getCategoryIds(): array
    {
        $userable = $this->input('userable');
        return isset($userable['categoryIds']) ? $userable['categoryIds'] : [];
    }

}
