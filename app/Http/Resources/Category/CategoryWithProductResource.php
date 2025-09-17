<?php

namespace App\Http\Resources\category;

use App\Http\Resources\Product\ProductCardResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryWithProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'=>$this->id,
            'name'=>$this->name,
            'image'=>$this->getFirstMediaUrl('logo'),
            'products'=> ProductCardResource::collection($this->products)
        ];
    }
}
