<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    use Response;

    
    public function index()
    {
        try {
            return $this->success('Success',Auth::user());
        } catch (\Exception $e) {
            return $this->fail();
        }
    }



}
