<?php

namespace App\Http\Requests\Operation;

use Illuminate\Foundation\Http\FormRequest;

class CreateOperationRequest extends FormRequest
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
            'sum'           => 'required',
            'user_id' => 'required|exists:users,id',
        ];
    }

    public function getSum(): string
    {
        return $this->input('sum');
    }

    public function getUserId(): int
    {
        return $this->input('user_id');
    }

    public function getCarId(): ?int
    {
        return $this->input('car_id');
    }

    public function getBranchId(): ?int
    {
        return $this->input('branch_id');
    }

    public function getDealId(): ?int
    {
        return $this->input('deal_id');
    }

    public function getExpenseItemId(): ?int
    {
        return $this->input('expense_item_id');
    }

    public function getType(): int
    {
        return $this->input('type');
    }

    public function getClientBalanceChange(): int
    {
        return $this->input('client_balance_change') ?? 0;
    }
}
