<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BankResource extends JsonResource
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
            'name' => $this->name,
            'code' => $this->code
        ];
    }
}
