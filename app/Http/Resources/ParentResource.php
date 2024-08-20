<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ParentResource extends JsonResource
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
            'parent_name' => $this->parent_name,
            'parent_email' => $this->parent_email,
            'phone' => $this->phone,
            'address' => $this->address,
            'addedOn' => $this->created_at->toFormattedDateString()
        ];
    }
}
