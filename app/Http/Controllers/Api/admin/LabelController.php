<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\LabelRequest;
use App\Http\Traits\Response;
use App\Services\LabelService;

class LabelController extends Controller
{

    use Response;
    public function __construct(private LabelService $ls) {}





    public function index()
    {

        try {
            return $this->success('success', $this->ls->index());
        } catch (\Exception $e) {
            return $this->fail();
        }
    }

    public function store(LabelRequest $r)
    {

        try {

            return $this->success('Add Successfuly', $this->ls->store($r->validated()));
        } catch (\Exception $e) {
            return $this->fail($e->getMessage());
        }
    }

    public function edit($id)
    {
        try {

            return $this->success('Add Successfuly', $this->ls->edit($id));
        } catch (\Exception $e) {
            return $this->fail();
        }
    }


    public function update($id, LabelRequest $r)
    {

        try {

            return $this->success('Add Successfuly', $this->ls->update($id, $r->validated()));
        } catch (\Exception $e) {
            return $this->fail();
        }
    }
    public function delete($id)
    {
        try {

            $this->ls->delete($id);
            return $this->success('Deleted Successfuly');
        } catch (\Exception $e) {
            return $this->fail();
        }
    }
}
