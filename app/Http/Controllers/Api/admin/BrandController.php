<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\BrandRequest;
use App\Http\Traits\Response;
use App\Services\BrandService;

class BrandController extends Controller
{

   use Response;

   public function __construct(private BrandService $bs) {}

   public function index()
   {

      return $this->success('Success', $this->bs->index());
   }

   public function store(BrandRequest $r)
   {
      try {
         return $this->success('Added Successfuly', $this->bs->store($r->validated()));
      } catch (\Exception $e) {
         $this->fail();
      }
   }

   public function edit($id)
   {

      try {
         return $this->success('success', $this->bs->edit($id));
      } catch (\Exception $e) {
         return  $this->fail($e->getMessage());
      }
   }


   public function update($id, BrandRequest $r)
   {

      try {
         return $this->success('success', $this->bs->update($id, $r->validated()));
      } catch (\Exception $e) {
         $this->fail();
      }
   }


   public function delete($id)
   {

      try {
         $this->bs->delete($id);
         return $this->success('success');
      } catch (\Exception $e) {
         $this->fail();
      }
   }
}
