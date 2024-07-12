<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
        return view('index', [
            'title' => 'Title',
            'activePage' => 'dashboard',
            'activeButton' => '',
            'navName' => 'Dashboard',
        ]);
    }
}
