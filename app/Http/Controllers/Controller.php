<?php

namespace App\Http\Controllers;

use ElePHPant\Breadcrumb\Breadcrumb;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $breadcrumb;

    public function __construct()
    {
        $this->breadcrumb = new Breadcrumb();
    }
}
