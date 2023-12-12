<?php

namespace App\Services\Category;
use App\Models\Category;

class Service
{
    public function store($request, $data)
    {
        $data['top_category'] = $request->input('top_category') ? 1 : 0;
        Category::create($data);
    }

    public function update($request, $data, $category)
    {
        $data['top_category'] = $request->input('top_category') ? 1 : 0;
        $category->update($data);
    }

}
