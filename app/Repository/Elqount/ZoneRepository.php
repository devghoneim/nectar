<?php 

namespace App\Repository\Elqount;

use App\Models\Zone;
use App\Repository\Interface\ZoneRepoistoryInterface;
use Illuminate\Support\Facades\DB;

class ZoneRepository implements ZoneRepoistoryInterface
{

 public function getAll()
     {
        try {
            return Zone::all();
            
        } catch (\Throwable $th) {
            throw $th;
        }
     }

    public function create($data)
    {
        try {
            $zone = Zone::create([
                'name'=>$data['name']
            ]);
            return $zone;
            
        } catch (\Throwable $th) {
            throw $th;
        }


    }
    public function edit($id)
    {

    }
    public function update($data)
    {

    }
    public function delete($id)
    {

    }
  



}