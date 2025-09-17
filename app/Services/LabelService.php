<?php

namespace App\Services;

use App\Models\Label;


class LabelService
{




    public function index()
    {


        return Label::with(['translations'])->get();
    }

    public function store($data)
    {

        $label = new Label();
        $label->save();
        $label->translateOrNew('ar')->name = $data['name']['ar'];
        $label->translateOrNew('en')->name = $data['name']['en'];
        $label->save();
        return $label;
    }

    public function edit($id)
    {

        return Label::with('translations')->findOrFail($id);
    }
    public function update($id, $data)
    {

        $label = Label::findOrFail($id);
        $label->translateOrNew('ar')->name = $data['name']['ar'];
        $label->translateOrNew('en')->name = $data['name']['en'];
        $label->save();
        return $label;
    }

    public function delete($id)
    {

        Label::findOrFail($id)->delete();
    }


    public function getLabelWithProduct()
    {
        return Label::with([
            'translations',
            'products' => fn($p) => $p->with(['translations', 'media'])->take(10)->get()
        ])->get();
    }
}
