<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Http\Requests\Public\FilterRequest;
use App\Http\Resources\Product\ProductResource;
use App\Http\Traits\Response;
use App\Models\Product;
use App\Services\FilterService;
use Illuminate\Http\Request;

class FilterController extends Controller
{

    use Response;

    public function __construct(private FilterService $fs) {}

    public function index()
    {
        try {

            return $this->success('success', $this->fs->index());
        } catch (\Exception $th) {
            return $this->fail();
        }
    }


    public function product(FilterRequest $r)
    {
        try {
            return $this->success('success', ProductResource::collection($this->fs->product($r->validated())));
        } catch (\Exception $e) {
            return $this->fail($e->getMessage());
        }
    }
}
