<?php

namespace App\Http\Controllers\Admin\Products;

use App\Http\Requests\Product\StoreRequest;
use App\Models\Product;

class StoreController extends BaseController
{
    public function __invoke(StoreRequest $request)
    {
        $data = $request->validated();

        $this->service->store($request, $data);

        return redirect(route('products.index'));
    }
}
