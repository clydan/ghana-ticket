<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class HeroMediaResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->uuid,
            'hero_title' => $this->hero_title,
            'hero_subtitle' => $this->hero_subtitle,
            'event_id' => $this->event_id,
            'images' => ImageResource::collection($this->images)
        ];
    }
}
