<?php

namespace App\Http\Controllers\Admin\Categories;

use App\Http\Requests\Category\UpdateRequest;
use App\Models\Category;

class UpdateController extends BaseController
{
    public function __invoke(UpdateRequest $request, Category $category)
    {
        $data = $request->validated();
        $this->service->update($request, $data, $category);
        return redirect(route('categories.index'));
    }
}
