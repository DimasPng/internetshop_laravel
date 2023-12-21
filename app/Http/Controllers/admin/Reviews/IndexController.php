<?php

namespace App\Http\Controllers\Admin\Reviews;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IndexController extends BaseController
{
    public function __invoke()
    {
        return view('admin.reviews.index');
    }
}
