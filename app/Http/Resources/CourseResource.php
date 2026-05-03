<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CourseResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // return parent::toArray($request);
        return [
        'id' => $this->id,
        'course_name' => $this->course_name,
        'course_code' => $this->course_code,
        'day' => $this->day,
        'date' => $this->date,
        'doctor' => $this->doctor,
        'location' => $this->location,
        'section' => new SectionResource($this->whenLoaded('section')),
    ];
    }
}
