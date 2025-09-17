<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProductRequest;
use App\Http\Traits\Response;
use App\Services\ProductService;

class ProductController extends Controller
{
    use Response;


    public function __construct(private ProductService $ps) {}





    public function index()
    {

        try {
            return $this->success('success', $this->ps->index());
        } catch (\Exception $e) {
            return $this->fail();
        }
    }





    public function store(ProductRequest $r)
    {

        try {

            return $this->success('Add Successfuly', $this->ps->store($r->validated()));
        } catch (\Exception $e) {
            return $this->fail($e->getMessage());
        }
    }

    public function show($id)
    {
        try {

            return $this->success('Add Successfuly', $this->ps->show($id));
        } catch (\Exception $e) {
            return $this->fail();
        }
    }


    public function update($id, ProductRequest $r)
    {

        try {

            return $this->success('Add Successfuly', $this->ps->update($id, $r->validated()));
        } catch (\Exception $e) {
            return $this->fail();
        }
    }


    public function delete($id)
    {
        try {

            $this->ps->delete($id);
            return $this->success('Deleted Successfuly');
        } catch (\Exception $e) {
            return $this->fail();
        }
    }
}
