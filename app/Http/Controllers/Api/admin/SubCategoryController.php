<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SubCategoryRequest;
use App\Http\Traits\Response;
use App\Services\SubCategoryService;

class SubCategoryController extends Controller
{

   use Response;

   public function __construct(private SubCategoryService $scs) {}




   public function index()
   {

      return $this->success('Success', $this->scs->index());
   }

   public function store(SubCategoryRequest $r)
   {
      try {
         return $this->success('Added Successfuly', $this->scs->store($r->validated()));
      } catch (\Exception $e) {
         $this->fail();
      }
   }

   public function edit($id)
   {

      try {
         return $this->success('success', $this->scs->edit($id));
      } catch (\Exception $e) {
         return  $this->fail($e->getMessage());
      }
   }


   public function update($id, SubCategoryRequest $r)
   {

      try {
         return $this->success('success', $this->scs->update($id, $r->validated()));
      } catch (\Exception $e) {
         return $this->fail();
      }
   }


   public function delete($id)
   {

      try {
         $this->scs->delete($id);
         return $this->success('success');
      } catch (\Exception $e) {
         $this->fail();
      }
   }
}
