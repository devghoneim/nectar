<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CategoryRequest;
use App\Http\Resources\Category\CategoryResource;
use App\Http\Traits\Response;
use App\Services\CategoryService;


class CategoryController extends Controller
{
   use Response;
   public function __construct(private CategoryService $cs) {}



   public function index()
   {

      return $this->success('Success', CategoryResource::collection($this->cs->index()));
   }

   public function store(CategoryRequest $r)
   {
      try {
         return $this->success('Added Successfuly', $this->cs->store($r->validated()));
      } catch (\Exception $e) {
         $this->fail();
      }
   }

   public function edit($id)
   {

      try {
         return $this->success('success', $this->cs->edit($id));
      } catch (\Exception $e) {
         return  $this->fail($e->getMessage());
      }
   }


   public function update($id, CategoryRequest $r)
   {

      try {
         return $this->success('success', $this->cs->update($id, $r->validated()));
      } catch (\Exception $e) {
         $this->fail();
      }
   }


   public function delete($id)
   {

      try {
         $this->cs->delete($id);
         return $this->success('Deleted SuccessFuly');
      } catch (\Exception $e) {
         $this->fail();
      }
   }
}
