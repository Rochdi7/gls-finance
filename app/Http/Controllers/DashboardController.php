<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        return view('admin.dashboard', [
            'page_title'       => 'Dashboard',
            'page_description' => 'GLS Finance Dashboard',
        ]);
    }
}
