<?php

namespace App\Services;

use App\Models\SubCategory;
use Illuminate\Support\Facades\DB;

class SubCategoryService
{


    public function index()
    {
       return SubCategory::with(['translation'])->get();
       
    }

    public function store($data)
    {
        try {
            DB::beginTransaction();
            $subCat = new SubCategory();
            $subCat->category_id = $data['category_id'];
            $subCat->save();

            foreach (['en', 'ar'] as $locale) {
                $subCat->translateOrNew($locale)->name = $data['name'][$locale];
            }
            $subCat->save();
            DB::commit();
            return $subCat->load('translations');
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }



    public function edit($id)
    {
        return SubCategory::findOrFail($id);
    }



    public function update($id, $data)
    {

        try {
            $subCat = SubCategory::findOrFail($id);
            DB::beginTransaction();
            $subCat->translateOrNew('ar')->name = $data['name']['ar'];
            $subCat->translateOrNew('en')->name = $data['name']['en'];
            $subCat->save();
            DB::commit();
            return $subCat;
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }
    public function delete($id)
    {
         SubCategory::findOrFail($id)->delete();
    }


    public function findSubCategoryByName($name)
    {
        return SubCategory::whereTranslationLike('name', "%{$name}%")->get();
    }
}
