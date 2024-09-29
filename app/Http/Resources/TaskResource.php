<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Enums\Priority;

class TaskResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
        	'task_id' => $this->task_id,
        	'title' => $this->title,
        	'description' => $this->description,
            'priority' => $this->priority,
            'completed' => $this->completed,
	    	'due_date' => $this->due_date,
            'created_at' => $this->created_at,
            'completed_at' => $this->completed_at,
            'deleted_at' => $this->deleted_at,
            'tags' => $this->tags,
        ];
    }
}
