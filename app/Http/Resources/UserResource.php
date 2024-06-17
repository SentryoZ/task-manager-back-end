<?php

namespace App\Http\Resources;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;

/** @mixin User */
class UserResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->description,
            'status' => __(Arr::get(User::STATUSES, $this->status)),
            'status_label' => $this->status,
            'role' => $this->role->id,
            'role_name' => $this->role->name,
            'avatar' => asset(Storage::url($this->avatar)),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
