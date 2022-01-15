<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    public function index()
    {
        $plans = Plan::with('planDetails')->orderBy('price')->get();

        return view('site.pages.index', compact('plans'));
    }
}
