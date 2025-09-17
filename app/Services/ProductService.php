<?php

namespace App\Services;

use App\Models\Product;

use function PHPUnit\Framework\isArray;

class ProductService
{




    public function index()
    {


        return Product::with(['translations', 'media', 'labels'])->get();
    }



    public function store($data)
    {
        try {
            $product = new Product();
            $product->category_id = $data['cat_id'];
            $product->sub_category_id = $data['sub_cat_id'];
            $product->brand_id = $data['brand_id'];
            $product->price = $data['price'];
            $product->offer = $data['offer'] ?? 0;
            $product->unit_value = $data['unit_value'];
            $product->unit_type = $data['unit_type'];
            $product->quantity = $data['quantity'];
            $product->status = $data['status'] ?? 1;
            $product->save();
            foreach (['ar', 'en'] as $locale) {
                $product->translateOrNew($locale)->name = $data['name'][$locale];
                $product->translateOrNew($locale)->description = $data['description'][$locale];
            }
            if (!empty($data['main_image'])) {
                $product->addMedia($data['main_image'])->toMediaCollection('main');
            }
            if (!empty($data['image'])) {
                foreach ($data['image'] as $image) {
                    $product->addMedia($image)->toMediaCollection('image');
                }
            }

            $product->labels()->sync($data['label']);
            $product->save();
            return $product;
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function show($id)
    {
        return Product::with('translations', 'media')->findOrFail($id);
    }



    public function update($id, $data)
    {

        try {
            $product = Product::findOrFail($id);
            $product->category_id = $data['cat_id'];
            $product->sub_category_id = $data['sub_cat_id'];
            $product->brand_id = $data['brand_id'];
            $product->price = $data['price'];
            $product->offer = $data['offer'] ?? 0;
            $product->unit_value = $data['unit_value'];
            $product->unit_type = $data['unit_type'];
            $product->quantity = $data['quantity'];
            $product->status = $data['status'] ?? 1;
            foreach (['ar', 'en'] as $locale) {
                $product->translateOrNew($locale)->name = $data['name'][$locale];
                $product->translateOrNew($locale)->description = $data['description'][$locale];
            }
            if (!empty($data['main_image'])) {
                $product->clearMediaCollection('main');
                $product->addMedia($data['main_image'])->toMediaCollection('main');
            }
            if (!empty($data['image'])) {
                $product->clearMediaCollection('image');
                foreach ($data['image'] as $image) {
                    $product->addMedia($image)->toMediaCollection('image');
                }
            }

            $product->labels()->sync($data['label']);
            $product->save();
            return $product;
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function delete($id)
    {
        Product::findOrFail($id)->delete();
    }

    public function findProductByName($name)
    {
        return Product::whereTranslationLike('name', "%{$name}%")->with(['media'])->get();
    }



    public function findProductByBrand($id)
    {
        return Product::when(is_array($id),fn($q)=>$q->whereIn('brand_id', $id),fn($q)=>$q->where('brand_id', $id))->with('translations', 'media')->get();
    }

    public function findProductByCategory($id)
    {
        return Product::when(is_array($id),fn($q)=>$q->whereIn('category_id', $id),fn($q)=>$q->where('category_id', $id))->with('translations', 'media')->get();
    }
    public function findProductBySubCategory($id)
    {
        return Product::when(is_array($id),fn($q)=>$q->whereIn('sub_category_id', $id),fn($q)=>$q->where('sub_category_id', $id))->with('translations', 'media')->get();
    }


    
    
}
