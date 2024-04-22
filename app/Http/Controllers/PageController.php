<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function welcome(): View {
        return view('welcome');
    }

    public function dashboard(): View {
        return view('pages.dashboard');
    }
}
