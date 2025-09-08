<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ZoneRequest;
use App\Http\Traits\Response;
use App\Services\LocationService;
use Illuminate\Http\Request;

class ZoneController extends Controller
{
    use Response;
    public function __construct(private LocationService $locationService)
    {
    }

    public function getAllZones()
    {

         $zones = $this->locationService->getAllZones();
         return $this->success('Success',$zones);

    }
       public function createZone(ZoneRequest $r){
        
        $zone = $this->locationService->createZone($r->validated());
        return $this->success('Success',$zone);
        }






}
