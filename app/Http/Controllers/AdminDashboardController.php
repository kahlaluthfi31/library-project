<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class AdminDashboardController extends Controller
{
    public function index(): View
    {
        $menus = [
            ['label' => 'Berita Terbaru', 'desc' => 'Kelola berita terbaru untuk landing page.', 'url' => route('dashboard.admin.content.index', 'berita')],
        ];

        return view('dashboard.admin.index', [
            'menus' => $menus,
        ]);
    }
}
