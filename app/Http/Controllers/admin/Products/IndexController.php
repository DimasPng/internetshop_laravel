<?php

namespace App\Http\Controllers\Admin\Products;

use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    public function __invoke()
    {
        return view('admin.products.index');
    }
}
