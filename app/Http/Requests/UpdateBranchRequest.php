<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBranchRequest extends FormRequest
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
            'id'              => 'required',
            'name'            => 'required',
            'address'         => 'required',
            'wa_token'        => 'required',
        ];
    }

    public function getId(): int
    {
        return $this->input('id');
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
