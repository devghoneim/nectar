<?php


namespace App\Services;

use App\Http\Resources\Front\Brand\BrandResource;
use App\Models\Brand;
use Illuminate\Support\Facades\DB;

class BrandService
{


    public function index()
    {
        return Brand::with(['translation'])->get();
    }

    public function store($data)
    {
        try {

            DB::beginTransaction();

            $brand = new Brand;

            $brand->save();

            foreach (['en', 'ar'] as $locale) {
                $brand->translateOrNew($locale)->name = $data['name'][$locale];
            }

            $brand->save();
            DB::commit();
            return $brand->load('translations');
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }



    public function edit($id)
    {
        return Brand::findOrFail($id);
    }



    public function update($id, $data)
    {
        $brand = Brand::findOrFail($id);
        $brand->translateOrNew('ar')->name = $data['name']['ar'];
        $brand->translateOrNew('en')->name = $data['name']['en'];
        $brand->save();
        return $brand;
    }
    public function delete($id)
    {
        return Brand::findOrFail($id)->delete();
    }



    public function findBrandByName($name)
    {
        return Brand::whereTranslationLike('name', "%{$name}%")->with(['translations'])->get();
    }
}
