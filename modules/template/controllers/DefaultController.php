<?php

namespace Modules\template\controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;

class DefaultController extends Controller
{
    public function index()
    {
        // return View::make('template::default.index');
        return view('template::default.index');
    }
}
