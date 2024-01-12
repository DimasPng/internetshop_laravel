<?php

namespace App\Services\Category;
use App\Models\Category;

class Service
{
    public function store($request, $data)
    {

        if($request->hasFile('image')) {
            $data['image'] = $request['image']->store('images', 'public');
        }

        $data['top_category'] = $request->input('top_category') ? 1 : 0;
        Category::create($data);
    }

    public function update($request, $data, $category)
    {
        if($request->hasFile('image')) {
            $data['image'] = $request['image']->store('images', 'public');
        }
        $data['top_category'] = $request->input('top_category') ? 1 : 0;
        $category->update($data);
    }

}
