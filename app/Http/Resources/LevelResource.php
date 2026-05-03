<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LevelResource extends JsonResource
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
        'name' => $this->name,
        'time' => $this->time,
        'laiha' => new LaihaResource($this->whenLoaded('laiha')),
        'sections' => SectionResource::collection($this->whenLoaded('sections')),
    ];
    }
}
