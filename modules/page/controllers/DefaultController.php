<?php

namespace Modules\page\controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;

class DefaultController extends Controller
{
    public function index()
    {
        // return View::make('page::default.index');
        return view('page::default.index');
    }
}
