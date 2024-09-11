<?php

namespace App\Http\Requests\User;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
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
            'email'               => 'required|email|unique:users',
            'password'            => 'required|min:6',
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

    public function getName(): string
    {
        return $this->input('name');
    }

    public function getEmail(): string
    {
        return $this->input('email');
    }

    public function getPassword(): string
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

    public function getBirthday()
    {
        $userable = $this->input('userable');
        return isset($userable['birthday']) ? Carbon::parse($userable['birthday']) : NULL;
    }

    public function getPassportSeries(): string
    {
        $userable = $this->input('userable');
        return isset($userable['passportSeries']) ? $userable['passportSeries'] : '';
    }

    public function getPassportNumber(): string
    {
        $userable = $this->input('userable');
        return isset($userable['passportNumber']) ? $userable['passportNumber'] : '';
    }

    public function getPassportNotes(): string
    {
        $userable = $this->input('userable');
        return isset($userable['passportNotes']) ? $userable['passportNotes'] : '';
    }

    public function getPassportIssueDate()
    {
        $userable = $this->input('userable');
        return isset($userable['passportIssueDate']) ? Carbon::parse($userable['passportIssueDate']) : NULL;
    }

    public function getRegistrationAddress(): string
    {
        $userable = $this->input('userable');
        return isset($userable['registrationAddress']) ? $userable['registrationAddress'] : '';
    }

    public function getPhone(): string
    {
        $userable = $this->input('userable');
        return isset($userable['phoneNumber']) ? preg_replace('|\D|Ui', '', $userable['phoneNumber']) : '';
    }
    public function getComment(): string
    {
        $userable = $this->input('userable');
        return isset($userable['comment']) ? $userable['comment'] : '';
    }

    public function getInn(): string
    {
        $userable = $this->input('userable');
        return isset($userable['inn']) ? $userable['inn'] : '';
    }

    public function getComplaints(): string
    {
        $userable = $this->input('userable');
        return isset($userable['complaints']) ? $userable['complaints'] : '';
    }

    public function getLastCheckFssp()
    {
        $userable = $this->input('userable');
        return isset($userable['lastCheckFssp']) ? Carbon::parse($userable['lastCheckFssp']) : NULL;
    }

    public function getLastCheckEnforcement()
    {
        $userable = $this->input('userable');
        return isset($userable['lastCheckEnforcement']) ? Carbon::parse($userable['lastCheckEnforcement']) : NULL;
    }

    public function getBalance()
    {
        $userable = $this->input('userable');
        return isset($userable['balance']) ? $userable['balance'] : 0;
    }

    public function getType()
    {
        $userable = $this->input('userable');
        return isset($userable['type']) ? $userable['type'] : 0;
    }

    public function getCompanyName(): string
    {
        $userable = $this->input('userable');
        return isset($userable['companyName']) ? $userable['companyName'] : '';
    }

    public function getRegNumber(): string
    {
        $userable = $this->input('userable');
        return isset($userable['regNumber']) ? $userable['regNumber'] : '';
    }

    public function getJurAddress(): string
    {
        $userable = $this->input('userable');
        return isset($userable['jurAddress']) ? $userable['jurAddress'] : '';
    }

    public function getFactAddress(): string
    {
        $userable = $this->input('userable');
        return isset($userable['factAddress']) ? $userable['factAddress'] : '';
    }

    public function getDirector(): string
    {
        $userable = $this->input('userable');
        return isset($userable['director']) ? $userable['director'] : '';
    }

    public function getBankDetails(): string
    {
        $userable = $this->input('userable');
        return isset($userable['bankDetails']) ? $userable['bankDetails'] : '';
    }

    public function getContractNumber()
    {
        $userable = $this->input('userable');
        return isset($userable['contractNumber']) ? $userable['contractNumber'] : '';
    }



}
