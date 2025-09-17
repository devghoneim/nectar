<?php

namespace App\Http\Controllers\Public;

use \Exception;
use App\Http\Controllers\Controller;
use App\Http\Resources\Category\CategoryResource;
use App\Http\Resources\category\CategoryWithProductResource;
use App\Http\Traits\Response;
use App\Services\CategoryService;

class ExploreController extends Controller
{
    

    public function __construct(private CategoryService $cs)
    {        
    }


    use Response;


    public function index()
    {

        try {
            

           $data = $this->cs->index();
            return $this->success('success',CategoryResource::collection($data));
            

        } catch (\Exception $e) {
            return $this->fail();
        }
    }


      public function productsByCategoryId($id)
    {

        try {
            

           $data = $this->cs->productsByCategoryId($id);
            return $this->success('success',new CategoryWithProductResource($data));
            

        } catch (\Exception $e) {
            return $this->fail();
        }
    }

     public function findCategoryByName($name)
    {
        try {
           $data = $this->cs->findCategoryByName($name);
            return $this->success('success', CategoryResource::collection($data));   
        } catch (Exception $e) {
            return $this->fail($e->getMessage());
        }
    }









}
