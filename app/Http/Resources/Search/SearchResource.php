<?php

namespace App\Http\Resources\Search;

use App\Http\Resources\Home\SummrayResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SearchResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'category'=>  SummrayResource::collection($this->resource['cat']),
            'sub_category'=> SummrayResource::collection($this->resource['sub_cat']),
            'brand'=> SummrayResource::collection($this->resource['brand']),
            'product'=> SummrayResource::collection($this->resource['pro']),
        ];
    }
}
