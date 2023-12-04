<?php

namespace app\Http\Controllers\admin;

use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    public function __invoke()
    {
        return view('admin.index');
    }
}
