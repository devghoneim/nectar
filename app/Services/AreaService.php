<?php

namespace App\Services;

use App\Http\Resources\User\Location\ZoneResource;
use App\Models\Area;

class AreaService
{


  public function index()
  {

    return ZoneResource::collection(Area::with('translations')->get());
  }

  public function store($data)
  {

    $area = new Area;
    $area->zone_id = $data['zone_id'];
    $area->save();
    $area->translateOrNew('ar')->name = $data['name']['ar'];
    $area->translateOrNew('en')->name = $data['name']['en'];
    $area->save();
    return $area;
  }


  public function edit($id)
  {
    return Area::findOrFail($id);
  }
  public function update($data)
  {

    $area =  Area::findOrFail($data['id']);
    $area->translateOrNew('ar')->name = $data['name']['ar'];
    $area->translateOrNew('en')->name = $data['name']['en'];
    $area->save();
    return $area;
  }
  public function delete($id)
  {

    Area::findOrFail($id)->delete();
  }

    public function getAreaByZoneId($id)
    {
      return Area::where('zone_id',$id)->get();
    }
}
