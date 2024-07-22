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
            'email' => $this->email,
            'status' => $this->status,
            'status_label' => __(Arr::get(User::STATUSES, $this->status)),
            'role' => is_null($this->role) ? 0 : $this->role->id,
            'role_name' => is_null($this->role) ? __('role.no_role') : $this->role->name,
            'policies' => is_null($this->role) ? [] : $this->role->policies,
            'avatar' => is_null($this->avatar) ? null : asset(Storage::url($this->avatar)),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
