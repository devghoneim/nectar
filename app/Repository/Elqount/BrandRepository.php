<?php

namespace App\Repository\Elqount;

use App\Http\Resources\BrandResource;
use App\Models\Brand;
use App\Models\BrandTranslation;
use App\Repository\Interface\BrandRepositoryInterface;
use Illuminate\Support\Facades\DB;

class BrandRepository implements BrandRepositoryInterface
{
    public function getAll()
    {
        try {
           $brands = Brand::with(['translation','media'])->get();
            return  BrandResource::collection($brands);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function create($data)
    {
        try {

            DB::beginTransaction();

            $brand = new Brand;

            $brand->save();

            foreach (['en', 'ar'] as $locale) {

                $brand->translateOrNew($locale)->name = $data['name'][$locale];

                $brand->translateOrNew($locale)->description = $data['description'][$locale];
            }

            $brand->save();

            $image = $data['image'];
            $brand->addMedia($image)->toMediaCollection('logo');
            DB::commit();
            return $brand->load('translations','media');

        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }




    public function edit($id) {}
    public function update($data) {}
    public function delete($id) {}
}
