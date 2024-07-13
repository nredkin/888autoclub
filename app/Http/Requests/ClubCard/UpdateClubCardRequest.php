<?php

namespace App\Http\Requests\ClubCard;

use Illuminate\Foundation\Http\FormRequest;

class UpdateClubCardRequest extends FormRequest
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
            'id'                  => 'required',
            'client_id'           => 'required',
            'club_card_level_id'  => 'required',
            'is_active'           => 'required',

        ];
    }

    public function getId(): int
    {
        return $this->input('id');
    }

    public function getClientId(): ?int
    {
        return $this->input('client_id');
    }

    public function getClubCardLevelId(): ?string
    {
        return $this->input('club_card_level_id');
    }

    public function getIsActive(): string
    {
        return $this->input('is_active');
    }
}
