<?php

namespace App\Services;

use App\Models\Product;

class FilterService
{

    public function __construct(private CategoryService $categoryService , private BrandService $brandService , private ProductService $productService)
    {
        
    }

   

    public function index()
    {
        
        $data['cat'] = $this->categoryService->index();
        $data['brand'] = $this->brandService->index();
        return $data;
    }

    public function product($data)
    {
        $product = $this->productService->findProductByBrand($data['brand']);
        $product = $this->productService->findProductByCategory($data['category']);
        return $product;
    }



}
