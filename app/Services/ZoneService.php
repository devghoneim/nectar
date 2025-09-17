<?php


namespace App\Services;

use App\Models\Zone;
use Illuminate\Support\Facades\DB;


class ZoneService
{


    public function index()
    {

        return Zone::with('translations')->get();
    }

    public function store($data)
    {
        try {
            DB::beginTransaction();
            $zone = new Zone;
            $zone->save();
            $zone->translateOrNew('ar')->name = $data['name']['ar'];
            $zone->translateOrNew('en')->name = $data['name']['en'];
            $zone->save();
            DB::commit();
            return $zone;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }


    public function edit($id)
    {
        return Zone::findOrfail($id);
    }


    public function update($data)
    {
        $zone = Zone::find($data['id']);

        $zone->translateORNew('ar')->name = $data['name']['ar'];
        $zone->translateORNew('en')->name = $data['name']['en'];
        $zone->save();
        return $zone;
    }
    public function delete($id)
    {
        Zone::findORFail($id)->delete();
    }

    public function areaByZone($r)
    {
        $validated = $r->validate([
            'area_id'=>['required','integer','exists:areas,id']
        ]);

        return Zone::where('area_id',$validated['area_id'])->get();
    }
}
