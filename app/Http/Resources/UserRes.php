<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserRes extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'users_id' => $this->users_id,
            'username' => $this->username,
            'password' => $this->password,
            'role' => $this->role,
            'email' => $this->email,
            'major' => $this->major,
            'class' => $this->class,
        ];
    }
}
