<?php

namespace App\Http\Controllers\Admin\Reviews;

use App\Http\Controllers\Controller;
use App\Http\Requests\Review\StoreRequest;
use App\Models\Product;
use http\Env\Response;
use Illuminate\Http\Request;

class StoreController extends BaseController
{
    public function __invoke(StoreRequest $request)
    {
        $data = $request->validated();
        $this->service->store($request, $data);
    }
}
