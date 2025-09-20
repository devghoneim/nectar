<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ZoneRequest;
use App\Http\Requests\Public\GetAreaRequest;
use App\Http\Traits\Response;
use App\Services\AreaService;
use App\Services\ZoneService;
use GuzzleHttp\Psr7\Request;

class ZoneController extends Controller
{
     use Response;
     public function __construct(private ZoneService $zs , private AreaService $areaService) {}

     public function index()
     {

          try {
               return $this->success('Success', $this->zs->index());
          } catch (\Exception $e) {
               return $this->fail();
          }
     }

     public function store(ZoneRequest $r)
     {

          try {

               return $this->success('Success', $this->zs->store($r->validated()));
          } catch (\Exception $e) {
               return $this->fail($e->getMessage());
          }
     }



     public function edit($id)
     {
          try {

               return $this->success('Success', $this->zs->edit($id));
          } catch (\Exception $e) {
               return $this->fail();
          }
     }
     public function update(ZoneRequest $r)
     {
          try {

               return $this->success('Success', $this->zs->update($r->validated()));
          } catch (\Exception $e) {
               return $this->fail();
          }
     }
     public function delete($id)
     {
          try {
               $this->zs->delete($id);
               return $this->success(__('messages.deleted_successfuly'));
          } catch (\Exception $e) {
               return $this->fail($e->getMessage());
          }
     }

     public function areaByZoneId(GetAreaRequest $r)
     {
          try {

               return $this->success('Success', $this->areaService->getAreaByZoneId($r->validated()));
          } catch (\Exception $e) {
               return $this->fail($e->getMessage());
          }
     }
}
