<?php

namespace App\Http\Requests\Employee;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class CreateEmployeeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'userId'              => 'required|numeric',
            'firstName'           => 'required',
            'middleName'          => '',
            'lastName'            => 'required',
            'branchId'            => 'required|numeric',
        ];
    }

    public function getUserId(): int
    {
        return $this->input('userId');
    }

    public function getFirstName(): string
    {
        return $this->input('firstName');
    }

    public function getMiddleName(): string
    {
        return $this->input('middleName') ?? '';
    }

    public function getLastName(): string
    {
        return $this->input('lastName');
    }

    public function getBranchId(): int
    {
        return $this->input('branchId');
    }

}
