<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin \App\Models\Task */
class TaskResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'start_time' => $this->start_time,
            'due_date' => $this->due_date,
            'user_id' => $this->user_id,
            'assigned_user_id' => $this->assigned_user_id,
            'user' => new UserResource($this->whenLoaded('user')),
            'assigned_user' => new UserResource($this->whenLoaded('assignedUser')),
            'project' => new ProjectResource($this->whenLoaded('project')),
            'project_id' => $this->project_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
