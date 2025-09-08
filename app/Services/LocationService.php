<?php 

namespace App\Services;

use App\Repository\Interface\LocationRepositoryInterface;
use App\Repository\Interface\ZoneRepoistoryInterface;

class LocationService
{


    public function __construct(private LocationRepositoryInterface  $repoLocation , private ZoneRepoistoryInterface $repoZone)
    {
    }

    public function getAllZones()
    {
       return $this->repoZone->getAll();
    }

      public function createZone($data){
        try {
            $zone =  $this->repoZone->create($data);
            return $zone;
        } catch (\Throwable $th) {
            throw $th;
        }






    }




















}