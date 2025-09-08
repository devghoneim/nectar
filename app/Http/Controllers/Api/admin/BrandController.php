<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\BrandRequest;
use App\Http\Traits\Response;
use App\Repository\Interface\BrandRepositoryInterface;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    
    use Response;

    public function __construct(private BrandRepositoryInterface $repo)
    {   
    }

    public function getAll(Request $r)
    {

       $brands = $this->repo->getAll();
       return $this->success('Success',$brands);

    }

    public function create(BrandRequest $r)
    {

       $brand = $this->repo->create($r->validated());
       return $this->success('Added Successfuly',$brand);

    }

    

}
