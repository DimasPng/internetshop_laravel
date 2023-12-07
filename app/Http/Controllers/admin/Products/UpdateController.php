<?php
namespace App\Http\Controllers\Admin\Products;

use App\Http\Requests\Product\UpdateRequest;
use App\Models\Product;

class UpdateController extends BaseController
{
    public function __invoke(UpdateRequest $request, Product $product)
    {
        $data = $request->validated();

        $this->service->update($request, $data, $product);

        return redirect(route('products.index'));
    }
}
