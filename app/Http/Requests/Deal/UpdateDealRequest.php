<?php

namespace App\Http\Requests\Deal;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDealRequest extends FormRequest
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
            'deal_type' => 'required|integer|in:0,1',
            'client_id' => 'required|exists:clients,id',
            'car_id' => 'required|exists:cars,id',
            'security_deposit' => 'required|numeric|min:0',
            'contract_date' => 'required|date',
            'rental_start' => 'nullable|date',
            'rental_end' => 'nullable|date|after_or_equal:rental_start',
        ];
    }

    public function getId(): int
    {
        return $this->input('id');
    }

    /**
     * Get the deal type.
     */
    public function getDealType(): int
    {
        return $this->input('deal_type');
    }

    /**
     * Get the client ID.
     */
    public function getClientId(): int
    {
        return $this->input('client_id');
    }

    /**
     * Get the car ID.
     */
    public function getCarId(): int
    {
        return $this->input('car_id');
    }

    /**
     * Get the security deposit.
     */
    public function getSecurityDeposit(): float
    {
        return $this->input('security_deposit');
    }

    /**
     * Get the contract date.
     */
    public function getContractDate(): string
    {
        return $this->input('contract_date');
    }

    /**
     * Get the rental start datetime.
     */
    public function getRentalStart(): ?string
    {
        return $this->input('rental_start');
    }

    /**
     * Get the rental end datetime.
     */
    public function getRentalEnd(): ?string
    {
        return $this->input('rental_end');
    }
}
