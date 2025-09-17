<?php

namespace App\Services;

use App\Models\Banner;
use Illuminate\Support\Facades\DB;

class BannerService
{


    public function index()
    {
        return Banner::with(['media', 'translations'])->get();
    }

    public function store($data)
    {

        $banner = new Banner();
        $banner->save();
        if (!empty($data['title'])) {
            $banner->translateOrNew('ar')->title = $data['title']['ar'];
            $banner->translateOrNew('en')->title = $data['title']['en'];
            if (!empty($data['sub_title'])) {
                $banner->translateOrNew('ar')->sub_title = $data['sub_title']['ar'];
                $banner->translateOrNew('en')->sub_title = $data['sub_title']['en'];
            }
        }


        if (!empty($data['image'])) {
            foreach ($data['image'] as $value) {
                $banner->addMedia($value)->toMediaCollection('banners');
            }
        }
        $banner->save();
        return $banner->load('media', 'translations');
    }

    public function edit($id)
    {

        return Banner::with(['media', 'translations'])->findOrFail($id);
    }
    public function update($id, $data)
    {


        $banner = Banner::findOrFail($id);
        if (!empty($data['title'])) {
            $banner->translateOrNew('ar')->name = $data['title']['ar'];
            $banner->translateOrNew('en')->name = $data['title']['en'];
            if (!empty($data['sub_title'])) {
                $banner->translateOrNew('ar')->sub_title = $data['sub_title']['ar'];
                $banner->translateOrNew('en')->sub_title = $data['sub_title']['en'];
            }
        }
        if (!empty($data['image'])) {
            $banner->clearMediaCollection('banners');
            foreach ($data['image'] as $value) {
                $banner->addMedia($value)->toMediaCollection('banners');
            }
        }
        $banner->save();


        return $banner->load('media', 'translations');
    }
    public function delete($id)
    {

        Banner::findOrFail($id)->delete();
    }
}
