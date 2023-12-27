<?php

namespace App\Http\Controllers\Admin\Reviews;

use App\Http\Requests\Review\LikeRequest;
use App\Http\Requests\Review\StoreRequest;

class StoreController extends BaseController
{
    public function __invoke(StoreRequest $request)
    {
        $data = $request->validated();
        $this->service->store($request, $data);
        return response()->json(['status' => 'ok'], 200);
    }

    public function storeLikes(LikeRequest $request)
    {
        $data = $request->validated();
        $this->service->storeLikes($request, $data);
        return response()->json(['status' => 'ok'], 200);

    }
}
