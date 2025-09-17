<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Http\Requests\Public\SearchRequest;
use App\Http\Resources\Home\IndexResource;
use App\Http\Resources\Product\ProductCardResource;
use App\Http\Resources\Product\ProductResource;
use App\Http\Resources\Search\SearchResource;
use App\Http\Traits\Response;
use App\Services\HomeService;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    use Response;
    public function __construct(private HomeService $hs)
    {
    }


public function index()
{
    try {
        return $this->success('success', new IndexResource($this->hs->index()));
        
    } catch (\Exception $e) {
        return $this->fail($e->getMessage());
    }
}

public function product($id)
{
    try {
        
        return $this->success('success', new ProductResource( $this->hs->product($id)));
        
    } catch (\Exception $e) {
        return $this->fail($e->getMessage());
    }
}

public function search($data)
{
    try {
        return $this->success('success', new SearchResource($this->hs->search($data)) );
    } catch (\Exception $e) {
        return $this->fail($e->getMessage());
    }
}

public function productBySearch(SearchRequest $r)
{

 try {
        return $this->success('success', ProductCardResource::collection($this->hs->productBySearch($r->validated())) );
    } catch (\Exception $e) {
        return $this->fail($e->getMessage());
    }


}







}
