<?php

namespace App\Http\Controllers\Admin\Categories;

use App\Http\Requests\Category\StoreRequest;
use App\Models\Category;

class StoreController extends BaseController
{
    public function __invoke(StoreRequest $request)
    {
        $data = $request->validated();
        $this->service->store($request, $data);
        return redirect(route('categories.index'));
    }
}
