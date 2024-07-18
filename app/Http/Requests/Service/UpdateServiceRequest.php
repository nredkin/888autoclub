<?php

namespace App\Http\Requests\Service;

use Illuminate\Foundation\Http\FormRequest;

class UpdateServiceRequest extends FormRequest
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
            'name'           => 'required',
            'photo'          => 'nullable|image', // Assuming you want to validate image uploads
            'unit'           => 'nullable',
            'with_driver'    => 'boolean',
            'uniform_cost_for_cards' => 'boolean',
            'is_active'      => 'boolean',
            'available_from_hours' => 'nullable|integer',
            'available_to_hours' => 'nullable|integer',
            'invoice_name'   => 'nullable',
            'is_collect'     => 'boolean',
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

    public function getPhoto(): ?string
    {
        return $this->file('photo'); // Assuming you want to access the uploaded photo file
    }

    public function getUnit(): ?string
    {
        return $this->input('unit');
    }

    public function getWithDriver(): bool
    {
        return (bool) $this->input('with_driver');
    }

    public function getUniformCostForCards(): bool
    {
        return (bool) $this->input('uniform_cost_for_cards');
    }

    public function getIsActive(): bool
    {
        return (bool) $this->input('is_active');
    }

    public function getAvailableFromHours(): ?int
    {
        return $this->input('available_from_hours') ? (int)$this->input('available_from_hours') : null;
    }

    public function getAvailableToHours(): ?int
    {
        return $this->input('available_to_hours') ? (int)$this->input('available_to_hours') : null;
    }

    public function getInvoiceName(): ?string
    {
        return $this->input('invoice_name');
    }

    public function getIsCollect(): bool
    {
        return (bool) $this->input('is_collect');
    }
}
