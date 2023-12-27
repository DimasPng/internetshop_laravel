<?php

namespace App\Http\Controllers\Admin\Cart;

use App\Http\Requests\Cart\StoreRequest;

class StoreController extends BaseController
{
    public function __invoke(StoreRequest $request)
    {
        $data = $request->validated();
        $this->service->store($request, $data);
    }
}
