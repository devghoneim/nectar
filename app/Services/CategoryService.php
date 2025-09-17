<?php

namespace App\Services;

use App\Http\Resources\Admin\Category\CategoryResource;
use App\Models\Category;
use Illuminate\Support\Facades\DB;

class CategoryService
{


    public function index()
    {
        return Category::with(['media', 'translations'])->get();
    }

    public function store($data)
    {
        try {

            DB::beginTransaction();
            $cat = new Category();
            $cat->save();

            foreach (['en', 'ar'] as $locale) {
                $cat->translateOrNew($locale)->name = $data['name'][$locale];
            }
            $cat->save();
            $image = $data['image'];
            $cat->addMedia($image)->toMediaCollection('logo');
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }



    public function edit($id)
    {
        return Category::with(['media', 'translations', 'subCategories'])->findOrFail($id);
    }



    public function update($id, $data)
    {

        try {

            DB::beginTransaction();

            $cat = Category::findOrFail($id);
            $cat->translateOrNew('ar')->name = $data['name']['ar'];
            $cat->translateOrNew('en')->name = $data['name']['en'];
            $cat->save();
            $image = $data['image'];
            if ($image) {
                $cat->clearMediaCollection('logo');
                $cat->addMedia($image)->toMediaCollection('logo');
            }


            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }
    public function delete($id)
    {
        $cat =  Category::findOrFail($id);
        $cat->clearMediaCollection('logo');
        $cat->delete();
    }


    public function CategoryWithProduct()
    {
        return Category::with([
            'translations',
            'media',
            'products' => fn($p) => $p->with(['translations', 'media'])->take(10)
        ])->take(10)->get();
    }

    public function productsByCategoryId($id)
    {
        return   Category::with(['translations', 'products'])->findOrFail($id);
    }

    public function findCategoryByName($name)
    {
        return  Category::whereTranslationLike('name', "%{$name}%")->with(['translations'])->get();
    }
}
