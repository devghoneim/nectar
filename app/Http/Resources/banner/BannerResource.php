<?php

namespace App\Http\Resources\banner;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BannerResource extends JsonResource
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
            'title'=>$this->title,
            'sub_title'=>$this->sub_title,
            'image'=>$this->getMedia('banners')->map(fn($m)=> $m->getUrl())
        ];
    }
}
