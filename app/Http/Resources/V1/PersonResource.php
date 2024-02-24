<?php

namespace App\Http\Resources\V1;

use App\Traits\formatterTrait;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PersonResource extends JsonResource
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
            'fullname' => $this->fullname,
            'birthDate' => $this->date_of_birth,
            'holderCpf' =>  $this->formatCpf($this->cpf),
            'address' => $this->address,
            'phoneNumber' => $this->phone_number,
            'email' => $this->email
        ];
    }
}
