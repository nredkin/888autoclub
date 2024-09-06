<?php

namespace App\Http\Resources;


use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ClientResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'                  => $this->resource->id,
            'firstName'           => $this->resource->first_name,
            'middleName'          => $this->resource->middle_name,
            'lastName'            => $this->resource->last_name,
            'passportSeries'      => $this->resource->passport_series,
            'passportNumber'      => $this->resource->passport_number,
            'passportNotes'       => $this->resource->passport_notes,
            'passportIssueDate'   => $this->resource->passport_issue_date ? Carbon::parse($this->resource->passport_issue_date)->format('Y-m-d') : '',
            'birthday'            => $this->resource->birthday ? Carbon::parse($this->resource->birthday)->format('Y-m-d') : '',
            'registrationAddress' => $this->resource->registration_address,
            'phoneNumber'         => $this->resource->phone_number,
            'inn'                 => $this->resource->inn,
            'lastCheckFssp'       => $this->resource->last_check_fssp ? Carbon::parse($this->resource->last_check_fssp)->format('Y-m-d') : '',
            'lastCheckEnforcement'=> $this->resource->last_check_enforcement ? Carbon::parse($this->resource->last_check_enforcement)->format('Y-m-d') : '',
            'comment'             => $this->resource->comment,
            'balance'             => $this->resource->balance,
            'bonus_points'        => $this->resource->bonus_points,
            'complaints'          => $this->resource->complaints,
            'categoryIds'         => $this->resource->category_ids,
            'clubCards'           => $this->resource->clubCards,
            'fullName'            => sprintf(
                '%s %s %s',
                $this->resource->last_name,
                $this->resource->first_name,
                $this->resource->middle_name
            ),
            'type'                 => $this->resource->type,
            'regNumber'           => $this->resource->reg_number,
            'jurAddress'          => $this->resource->jur_address,
            'factAddress'         => $this->resource->fact_address,
            'director'             => $this->resource->director,
            'bankDetails'         => $this->resource->bank_details,

        ];
    }
}
