<?php

namespace App\Http\Resources\Home;

use App\Http\Resources\banner\BannerResource;
use App\Http\Resources\Category\CategoryWithProductResource;
use App\Http\Resources\Label\LabelWithProductResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class IndexResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'location'=> [
                'zone'=>$this->resource['location']->zone->name ,
                'area'=> $this->resource['location']->area->name,
            ],
            'banner' => BannerResource::collection($this->resource['banner']),
            'label'=>  LabelWithProductResource::collection($this->resource['label']) ,
            'category'=>CategoryWithProductResource::collection($this->resource['category']),

        ];
    }
}
