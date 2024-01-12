<?php

namespace App\Http\Controllers\Admin\Characteristics;

use App\Http\Requests\Characteristic\StoreRequest;
use App\Services\Characteristic\Service;

class StoreController extends BaseController
{
    public function __invoke(StoreRequest $request, Service $service)
    {
        $data = $request->validated();
        $result = $this->service->store($data);
        return response()->json($result);
    }
}
