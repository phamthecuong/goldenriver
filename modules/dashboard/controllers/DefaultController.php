<?php

namespace Modules\dashboard\controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DefaultController extends Controller
{
    public function index()
    {
        return view('dashboard::dashboard.index');
    }
}
