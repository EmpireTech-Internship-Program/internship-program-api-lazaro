<?php

namespace App\Http\Resources\V1;

use App\Traits\formatterTrait;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AccountResource extends JsonResource
{

    use formatterTrait;

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
            'holderCPF' => $this->formatCpf($this->person_cpf),
            'agency' => $this->agency_name,
            'accountType' => $this->type,
            'accountNumber' => $this->formatNumber($this->number),
            'accountHolder'=> $this->holder,
            'openingBalance' => 'R$ ' . number_format($this->opening_balance, 2, ',', '.'),
            'openingDate' => $this->opening_date
        ];
    }
}
