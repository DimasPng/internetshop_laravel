<?php

namespace App\Http\Controllers\Admin\Characteristics;

use App\Http\Controllers\Controller;
use App\Services\Characteristic\Service;

class BaseController extends Controller
{
    public $service;

    public function __construct(Service $service)
    {
        $this->service = $service;
    }

}
