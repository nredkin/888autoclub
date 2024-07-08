<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateBranchRequest extends FormRequest
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
            'name'           => 'required',
            'address'        => 'required',
        ];
    }

    public function getName(): string
    {
        return $this->input('name');
    }

    public function getAddress(): ?string
    {
        return $this->input('address');
    }

    public function getWaToken(): ?string
    {
        return $this->input('wa_token');
    }
}
