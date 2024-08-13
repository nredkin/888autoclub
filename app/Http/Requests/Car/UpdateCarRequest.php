<?php

namespace App\Http\Requests\Car;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class UpdateCarRequest extends FormRequest
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
            'model'             => 'required|string',
            'vin'               => 'required|string',
            'year'              => 'required|integer',
            'engine_model'      => 'required|string',
            'engine_power'     => 'required|string',
            'color'             => 'string',
            'cost'              => 'required|numeric',
            'branch_id'         => 'required|exists:branches,id', // Ensure branch exists
            'registration_series' => 'required|string',
            'registration_number' => 'required|string',
            'pts_number'        => 'string',
            'pts_date'          => 'date', // Optional date validation if required
            'reg_sign'         => 'string',
            'description'       => 'nullable|string',
            'act_file_id'       => 'nullable|integer',
        ];
    }

    public function getId(): int
    {
        return $this->input('id');
    }

    public function getModel(): string
    {
        return $this->input('model');
    }

    public function getVin(): string
    {
        return $this->input('vin');
    }

    public function getYear(): int
    {
        return (int) $this->input('year');
    }

    public function getEngineModel(): string
    {
        return $this->input('engine_model');
    }

    public function getEnginePower(): string
    {
        return $this->input('engine_power');
    }

    public function getColor(): string
    {
        return $this->input('color');
    }

    public function getCost(): float
    {
        return (float)$this->input('cost');
    }

    public function getBranchId(): int
    {
        return (int) $this->input('branch_id');
    }

    public function getRegistrationSeries(): string
    {
        return $this->input('registration_series');
    }

    public function getRegistrationNumber(): string
    {
        return $this->input('registration_number');
    }

    public function getPtsNumber(): ?string
    {
        return $this->input('pts_number');
    }

    public function getPtsDate(): ?Carbon
    {
        return $this->input('pts_date') ? Carbon::parse($this->input('pts_date')) : null;
    }

    public function getRegSign(): string
    {
        return $this->input('reg_sign');
    }

    public function getDescription(): ?string
    {
        return $this->input('description');
    }

    public function getActFileId(): int
    {
        return $this->input('act_file_id');
    }
}
