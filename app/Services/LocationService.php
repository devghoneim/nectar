<?php

namespace App\Services;

use App\Http\Resources\User\Location\ZoneResource;
use App\Models\Area;
use App\Models\Location;
use App\Models\Zone;
use Illuminate\Support\Facades\Auth;
use Locale;

class LocationService
{


  public function getUserLocations()
  {
    return Location::with(['zone', 'area'])->where('user_id', Auth::id())->latest()->first();
  }



  public function index()
  {
    Auth::user()->hasAnyRole(['owner','admin']) ?Location::with(['zone', 'area','user'])->get()  :Location::with(['zone', 'area'])->where('user_id', Auth::id())->get();
  }


  public function store($data)
  {
    return Location::create([
      'user_id' => Auth::user()->id,
      'zone_id' => $data['zone_id'],
      'area_id' => $data['area_id'],
    ]);
  }


  public function edit($id)
  {

    return Location::with(['zone', 'area'])->where('user_id', Auth::id())->findOrFail($id);
  }
  public function update($data)
  {

    $location =  Location::findOrFail($data['id']);
    $location->zone_id = $data['zone_id'];
    $location->area_id = $data['area_id'];
    $location->save();
    return $location;
  }
  public function delete($id)
  {
    Location::findOrFail($id)->delete();
  }
}
