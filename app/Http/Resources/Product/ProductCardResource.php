<?php

namespace App\Http\Resources\Product;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductCardResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [ 
            'id'=> $this->id,
            'name'=> $this->name,
            'price'=> $this->price,
            'unit_type'=> $this->unit_type,
            'unit_value'=> $this->unit_value,
            'image'=> $this->getFirstMediaUrl('main'),
            'sub_category'=>$this->subCategory->name,
        ];
    }
}
