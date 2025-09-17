<?php

namespace App\Http\Resources\Product;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
            'description'=> $this->description,
            'unit_type'=> $this->unit_type,
            'unit_value'=> $this->unit_value,
            'unit_value'=> $this->unit_value,
            'sub_category'=>$this->subCategory->name,
            'quantity'=>$this->quantity,
            'image'=> $this->getMedia('image')->map(fn($m) => $m->getUrl()),
        ];
    }
}
