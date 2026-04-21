<?php

use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardContentController;
use App\Http\Controllers\DashboardInboxController;
use App\Http\Controllers\DashboardProfileController;
use App\Http\Controllers\DashboardSettingController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\ProfilePageController;
use App\Http\Controllers\SuperAdminDashboardController;
use App\Http\Controllers\SurveyController;
use Illuminate\Support\Facades\Route;

Route::get('/', [LandingPageController::class, 'index'])->name('landing-page');

Route::get('/survei-layanan', function () { //surveyForm itu nama path yang digunakan
    return view('surveiForm'); //nama file nya
})->name('survei-layanan');
Route::post('/survei-layanan', [SurveyController::class, 'store'])->name('survei-layanan.store');

Route::get('/daftar-keanggotaan', function () { //surveyForm itu nama path yang digunakan
    return view('formAnggota'); //nama file nya
})->name('daftar-keanggotaan');

Route::get('/profil-perpustakaan', [ProfilePageController::class, 'index'])->name('profil-perpustakaan');

Route::get('/blog-perpustakaan', function () { //surveyForm itu nama path yang digunakan
    return view('blog'); //nama file nya
})->name('blog-perpustakaan');

Route::get('/page-admin', function () { //surveyForm itu nama path yang digunakan
    return view('superadmin/pageAdmin'); //nama file nya
})->name('page-admin');
Route::post('/feedback', [FeedbackController::class, 'store'])->name('feedback.store');

Route::get('/layanan/{slug}', function (string $slug) {
    $layananMap = [
        'peminjaman-buku' => [
            'judul' => 'Peminjaman Buku',
            'ringkasan' => 'Layanan peminjaman koleksi buku cetak untuk siswa, guru, dan tenaga kependidikan.',
            'deskripsi' => 'Layanan ini memudahkan anggota perpustakaan untuk meminjam buku sesuai kebutuhan belajar. Proses peminjaman dilakukan melalui petugas perpustakaan dengan verifikasi kartu anggota.',
            'galeri' => [
                'https://images.unsplash.com/photo-1524995997946-a1c2e315a42f?q=80&w=1400&auto=format&fit=crop',
                'https://images.unsplash.com/photo-1513001900722-370f803f498d?q=80&w=1400&auto=format&fit=crop',
                'https://images.unsplash.com/photo-1507842217343-583bb7270b66?q=80&w=1400&auto=format&fit=crop',
            ],
            'catatan' => [
                'Bawa kartu anggota saat peminjaman.',
                'Periksa kondisi buku sebelum dibawa pulang.',
                'Hubungi petugas jika terjadi kendala saat pengembalian.',
            ],
            'peraturan' => [
                'Masa pinjam maksimal 7 hari dan dapat diperpanjang 1 kali.',
                'Maksimal peminjaman 2 buku per anggota.',
                'Keterlambatan pengembalian dikenakan sanksi sesuai ketentuan perpustakaan.',
            ],
        ],
        'digital-library' => [
            'judul' => 'Digital Library',
            'ringkasan' => 'Akses e-book, jurnal, dan referensi digital kapan saja melalui perangkat Anda.',
            'deskripsi' => 'Digital Library memberikan kemudahan akses koleksi digital untuk menunjang pembelajaran mandiri maupun tugas akademik.',
            'galeri' => [
                'https://images.unsplash.com/photo-1515879218367-8466d910aaa4?q=80&w=1400&auto=format&fit=crop',
                'https://images.unsplash.com/photo-1461749280684-dccba630e2f6?q=80&w=1400&auto=format&fit=crop',
                'https://images.unsplash.com/photo-1555421689-491a97ff2040?q=80&w=1400&auto=format&fit=crop',
            ],
            'catatan' => [
                'Gunakan akun anggota perpustakaan untuk login.',
                'Pastikan koneksi internet stabil saat mengakses dokumen besar.',
                'Simpan daftar bacaan untuk akses cepat.',
            ],
            'peraturan' => [
                'Akses hanya untuk kebutuhan belajar dan riset.',
                'Dilarang menyebarluaskan file berhak cipta tanpa izin.',
                'Ikuti ketentuan lisensi pada setiap sumber digital.',
            ],
        ],
        'layanan-konsultasi' => [
            'judul' => 'Layanan Konsultasi',
            'ringkasan' => 'Pendampingan pencarian referensi dan strategi literasi informasi.',
            'deskripsi' => 'Pengguna dapat berkonsultasi dengan pustakawan terkait pencarian sumber, pemilihan referensi, dan penggunaan katalog secara efektif.',
            'galeri' => [
                'https://images.unsplash.com/photo-1523240795612-9a054b0db644?q=80&w=1400&auto=format&fit=crop',
                'https://images.unsplash.com/photo-1454165804606-c3d57bc86b40?q=80&w=1400&auto=format&fit=crop',
                'https://images.unsplash.com/photo-1552664730-d307ca884978?q=80&w=1400&auto=format&fit=crop',
            ],
            'catatan' => [
                'Bawa topik atau kebutuhan informasi yang spesifik.',
                'Sediakan waktu konsultasi minimal 15 menit.',
                'Catat rekomendasi sumber dari pustakawan untuk tindak lanjut.',
            ],
            'peraturan' => [
                'Konsultasi mengikuti jam layanan perpustakaan.',
                'Antrian konsultasi bersifat first come first served.',
                'Gunakan bahasa dan etika komunikasi yang baik.',
            ],
        ],
        'akses-internet' => [
            'judul' => 'Akses Internet',
            'ringkasan' => 'Fasilitas koneksi internet untuk mendukung proses belajar dan penelusuran referensi.',
            'deskripsi' => 'Perpustakaan menyediakan akses internet yang dapat digunakan anggota untuk tugas sekolah, riset, dan aktivitas akademik lainnya.',
            'galeri' => [
                'https://images.unsplash.com/photo-1518770660439-4636190af475?q=80&w=1400&auto=format&fit=crop',
                'https://images.unsplash.com/photo-1488190211105-8b0e65b80b4e?q=80&w=1400&auto=format&fit=crop',
                'https://images.unsplash.com/photo-1517430816045-df4b7de11d1d?q=80&w=1400&auto=format&fit=crop',
            ],
            'catatan' => [
                'Gunakan koneksi untuk aktivitas pembelajaran.',
                'Pilih situs yang aman dan terpercaya.',
                'Laporkan gangguan jaringan kepada petugas.',
            ],
            'peraturan' => [
                'Dilarang mengakses konten yang tidak relevan dengan pembelajaran.',
                'Tidak diperbolehkan mengunduh aplikasi ilegal.',
                'Gunakan bandwidth secara bijak agar tetap nyaman untuk semua pengguna.',
            ],
        ],
        'pelatihan-literasi' => [
            'judul' => 'Pelatihan Literasi',
            'ringkasan' => 'Kegiatan workshop dan pelatihan literasi informasi secara berkala.',
            'deskripsi' => 'Pelatihan ini bertujuan meningkatkan kemampuan siswa dalam mencari, mengevaluasi, dan menggunakan informasi secara efektif dan bertanggung jawab.',
            'galeri' => [
                'https://images.unsplash.com/photo-1511629091441-ee46146481b6?q=80&w=1400&auto=format&fit=crop',
                'https://images.unsplash.com/photo-1544717305-2782549b5136?q=80&w=1400&auto=format&fit=crop',
                'https://images.unsplash.com/photo-1529078155058-5d716f45d604?q=80&w=1400&auto=format&fit=crop',
            ],
            'catatan' => [
                'Ikuti jadwal pelatihan yang diumumkan sekolah.',
                'Bawa alat tulis atau perangkat sesuai kebutuhan sesi.',
                'Aktif bertanya untuk memaksimalkan pemahaman.',
            ],
            'peraturan' => [
                'Peserta wajib hadir tepat waktu.',
                'Selama sesi berlangsung, jaga ketertiban ruang pelatihan.',
                'Gunakan materi pelatihan untuk keperluan pembelajaran.',
            ],
        ],
        'ruang-baca' => [
            'judul' => 'Ruang Baca',
            'ringkasan' => 'Area membaca dan belajar yang nyaman untuk kegiatan literasi harian.',
            'deskripsi' => 'Ruang baca dirancang untuk menciptakan suasana belajar yang tenang dengan fasilitas meja baca, koleksi referensi, dan dukungan lingkungan yang kondusif.',
            'galeri' => [
                'https://images.unsplash.com/photo-1497633762265-9d179a990aa6?q=80&w=1400&auto=format&fit=crop',
                'https://images.unsplash.com/photo-1481627834876-b7833e8f5570?q=80&w=1400&auto=format&fit=crop',
                'https://images.unsplash.com/photo-1463320898484-cdee8141c787?q=80&w=1400&auto=format&fit=crop',
            ],
            'catatan' => [
                'Pilih tempat duduk sesuai kapasitas yang tersedia.',
                'Jaga kebersihan meja dan area baca.',
                'Gunakan ruang baca untuk aktivitas belajar yang produktif.',
            ],
            'peraturan' => [
                'Dilarang membuat kebisingan di area ruang baca.',
                'Makanan dan minuman tidak diperkenankan di atas meja koleksi.',
                'Kembalikan buku ke troli pengembalian setelah selesai digunakan.',
            ],
        ],
    ];

    abort_unless(array_key_exists($slug, $layananMap), 404);

    return view('layananDetail', [
        'layanan' => $layananMap[$slug],
        'slug' => $slug,
    ]);
})->name('layanan-detail');

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.attempt');

    Route::get('/super-admin/login', [AuthController::class, 'showLogin'])->name('superadmin.login');
    Route::post('/super-admin/login', [AuthController::class, 'login'])->name('superadmin.login.attempt');
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::prefix('dashboard/super-admin')
        ->name('dashboard.super.')
        ->middleware('role:super_admin')
        ->group(function () {
            Route::get('/', [SuperAdminDashboardController::class, 'index'])->name('index');

            Route::prefix('/content/{module}')
                ->name('content.')
                ->group(function () {
                    Route::get('/', [DashboardContentController::class, 'index'])->name('index');
                    Route::get('/create', [DashboardContentController::class, 'create'])->name('create');
                    Route::post('/', [DashboardContentController::class, 'store'])->name('store');
                    Route::get('/{id}/edit', [DashboardContentController::class, 'edit'])->name('edit');
                    Route::put('/{id}', [DashboardContentController::class, 'update'])->name('update');
                    Route::delete('/{id}', [DashboardContentController::class, 'destroy'])->name('destroy');
                });

            Route::get('/settings', [DashboardSettingController::class, 'index'])->name('settings.index');
            Route::post('/settings', [DashboardSettingController::class, 'update'])->name('settings.update');

            Route::get('/profile', [DashboardProfileController::class, 'index'])->name('profile.index');
            Route::post('/profile/{tab}', [DashboardProfileController::class, 'update'])->name('profile.update');

            Route::get('/survey-submissions', [DashboardInboxController::class, 'survey'])->name('survey.index');
            Route::get('/feedback-submissions', [DashboardInboxController::class, 'feedback'])->name('feedback.index');
        });

    Route::prefix('dashboard/admin')
        ->name('dashboard.admin.')
        ->middleware('role:admin')
        ->group(function () {
            Route::get('/', [AdminDashboardController::class, 'index'])->name('index');

            Route::prefix('/content/{module}')
                ->name('content.')
                ->group(function () {
                    Route::get('/', [DashboardContentController::class, 'index'])->name('index');
                    Route::get('/create', [DashboardContentController::class, 'create'])->name('create');
                    Route::post('/', [DashboardContentController::class, 'store'])->name('store');
                    Route::get('/{id}/edit', [DashboardContentController::class, 'edit'])->name('edit');
                    Route::put('/{id}', [DashboardContentController::class, 'update'])->name('update');
                    Route::delete('/{id}', [DashboardContentController::class, 'destroy'])->name('destroy');
                });
        });
});