<?php

namespace App\Http\Resources\Label;

use App\Http\Resources\Product\ProductCardResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LabelWithProductResource extends JsonResource
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
            'products'=> ProductCardResource::collection($this->products)

        ];
    }
}
