<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AgencyResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'user' => [
                'id'=> $this->user->id,
                'userID' => $this->user->userID,
                'email' => $this->user->email
            ],
            'bankName' => $this->bank_name,
            'agencyName' => $this->name,
            'agencyNumber' => $this->number,
            'agencyAddress' => $this->address,
            'agencyCode' => $this->code
        ];
    }
}
