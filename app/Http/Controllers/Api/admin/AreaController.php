<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AreaRequest;
use App\Http\Traits\Response;
use App\Services\AreaService;

class AreaController extends Controller
{
    use Response;
    public function __construct(private AreaService $as) {}


    public function index()
    {
        try {

            return $this->success('sussess', $this->as->index());
        } catch (\Exception $e) {
            return $this->fail($e->getMessage());
        }
    }

    public function store(AreaRequest $r)
    {
        try {

            return $this->success('sussess', $this->as->store($r->validated()));
        } catch (\Exception $e) {
            return $this->fail($e->getMessage());
        }
    }


    public function edit($id)
    {


        try {

            return $this->success('sussess', $this->as->edit($id));
        } catch (\Exception $e) {
            return $this->fail($e->getMessage());
        }
    }
    public function update(AreaRequest $r)
    {


        try {


            return $this->success('sussess', $this->as->update($r->validated()));
        } catch (\Exception $e) {
            return $this->fail($e->getMessage());
        }
    }
    public function delete($id)
    {


        try {

            $this->as->delete($id);
            return $this->success(__('messages.deleted_successfuly'));
        } catch (\Exception $e) {
            return $this->fail($e->getMessage());
        }
    }
}
