<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
// use App\Http\Resources\resources\TaskResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class TaskCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {	
        return parent::toArray($request);
    }

    // public function paginationInformation($request, $paginated, $default)
    // {
    //     unset($default['links'], $default['meta']['links']);

    //     return $default;
    // }
}
