<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class SuperAdminDashboardController extends Controller
{
    public function index(): View
    {
        $menus = [
            ['label' => 'Eksplorasi Perpustakaan Kami', 'desc' => 'Kelola item slider profil perpustakaan.', 'url' => route('dashboard.super.content.index', 'eksplorasi')],
            ['label' => 'Layanan Perpustakaan', 'desc' => 'Kelola layanan utama dan detail layanan.', 'url' => route('dashboard.super.content.index', 'layanan')],
            ['label' => 'Berita Terbaru', 'desc' => 'Kelola berita terbaru yang tampil di landing page.', 'url' => route('dashboard.super.content.index', 'berita')],
            ['label' => 'Data Survei', 'desc' => 'Lihat pengguna/pengunjung yang mengisi survei layanan.', 'url' => route('dashboard.super.survey.index')],
            ['label' => 'FAQs', 'desc' => 'Kelola daftar pertanyaan yang sering ditanyakan.', 'url' => route('dashboard.super.content.index', 'faqs')],
            ['label' => 'Partner', 'desc' => 'Kelola logo dan nama partner.', 'url' => route('dashboard.super.content.index', 'partner')],
            ['label' => 'Profil', 'desc' => 'Kelola konten halaman Profil Perpustakaan per section.', 'url' => route('dashboard.super.profile.index')],
            ['label' => 'Saran dan Masukan', 'desc' => 'Lihat data saran dan masukan dari pengunjung.', 'url' => route('dashboard.super.feedback.index')],
            ['label' => 'Setting Landing Page', 'desc' => 'Kelola hero, section heading, kontak, dan footer.', 'url' => route('dashboard.super.settings.index')],
        ];

        return view('dashboard.superadmin.index', [
            'menus' => $menus,
        ]);
    }
}
