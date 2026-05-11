<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FamilyMemberResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'head_of_family' => new HeadOfFamilyResource($this->whenLoaded('headOfFamily')),
            'user' => new UserResource($this->user),
            'identity_number' => $this->identity_number,
            'phone_number' => $this->phone_number,
            'profile_picture' => $this->profile_picture,
            'gender' => $this->gender,
            'date_of_birth' => $this->date_of_birth,
            'occupation' => $this->occupation,
            'marital_status' => $this->marital_status,
            'relation' => $this->relation,
        ];
    }
}
