<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Student;
use App\Models\School;

class ClassesResource extends JsonResource
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
            'name' => $this->name,
            'students' =>  Student::where('school_id' ,School::activeSchool()->id)->where('class_id' , $this->id)->count(),
            'addedOn' => $this->created_at->toFormattedDateString(),
            'subjects' => $this->whenLoaded('subjects'),
        ];
    }
}
