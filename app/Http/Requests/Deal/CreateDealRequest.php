<?php

namespace App\Http\Requests\Deal;

use Illuminate\Foundation\Http\FormRequest;

class CreateDealRequest extends FormRequest
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
            'deal_type' => 'required|integer|in:0,1',
            'user_id' => 'required|exists:users,id',
            'car_id' => 'required|exists:cars,id',
            'branch_id' => 'required|exists:branches,id',
            'security_deposit' => 'required|numeric|min:0',
            'contract_date' => 'required|date',
            'rental_start' => 'nullable|date',
            'rental_end' => 'nullable|date|after_or_equal:rental_start',
            'comment' => 'nullable',
        ];
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
    public function getUserId(): int
    {
        return $this->input('user_id');
    }

    /**
     * Get the car ID.
     */
    public function getCarId(): int
    {
        return $this->input('car_id');
    }

    /**
     * Get the branch ID.
     */
    public function getBranchId(): int
    {
        return $this->input('branch_id');
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

    /**
     * Get comment.
     */
    public function getComment(): ?string
    {
        return $this->input('comment');
    }
}
