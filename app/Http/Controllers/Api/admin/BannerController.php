<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\BannerRequest;
use App\Http\Traits\Response;
use App\Services\BannerService;

class BannerController extends Controller
{
    use Response;
    public function __construct(private BannerService $bs) {}





    public function index()
    {

        try {
            return $this->success('success', $this->bs->index());
        } catch (\Exception $e) {
            return $this->fail();
        }
    }

    public function store(BannerRequest $r)
    {


        try {

            return $this->success('Add Successfuly', $this->bs->store($r->validated()));
        } catch (\Exception $e) {
            return $this->fail($e->getMessage());
        }
    }

    public function edit($id)
    {
        try {

            return $this->success('Add Successfuly', $this->bs->edit($id));
        } catch (\Exception $e) {
            return $this->fail();
        }
    }
    public function update($id, BannerRequest $r) {}
    public function delete($id)
    {
        try {

            $this->bs->delete($id);
            return $this->success('Deleted Successfuly');
        } catch (\Exception $e) {
            return $this->fail($e->getMessage());
        }
    }
}
