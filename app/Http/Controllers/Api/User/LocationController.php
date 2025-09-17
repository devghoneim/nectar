<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\LocationRequest;
use App\Http\Traits\Response;
use App\Services\LocationService;

class LocationController extends Controller
{
    use Response;
    public function __construct(private LocationService $ls) {}


    public function index()
    {
        try {
            return $this->success('Success', $this->ls->index());
        } catch (\Throwable $e) {
            return $this->fail();
        }
    }



    public function store(LocationRequest $r)
    {
        try {
            return $this->success('success', $this->ls->store($r->validated()));
        } catch (\Exception $e) {
            return $this->fail($e->getMessage());
        }
    }



    public function edit($id)
    {
        try {

            return $this->success('success', $this->ls->edit($id));
        } catch (\Exception $e) {
            return $this->fail();
        }
    }





    public function update(LocationRequest $r)
    {
        try {
            return $this->success('success', $this->ls->update($r->validated()));
        } catch (\Exception $e) {
            return $this->fail();
        }
    }
    public function delete($id)
    {
        try {
            $this->ls->delete($id);
            return $this->success('success');
        } catch (\Exception $e) {
            return $this->fail();
        }
    }
}
