<?php

namespace App\Http\Resources;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Arr;

/** @mixin Project */
class ProjectResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'short_description' => $this->short_description,
            'status' => $this->status,
            'status_label' => __(Arr::get(Project::STATUSES, $this->status)),
            'visibility' => $this->visibility,
            'visibility_label' => __(Arr::get(Project::VISIBILITIES, $this->visibility)),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
