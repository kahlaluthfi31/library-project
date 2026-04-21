<?php

namespace Database\Seeders;

use App\Models\ExplorationItem;
use App\Models\Faq;
use App\Models\LibraryService;
use App\Models\NewsItem;
use App\Models\Partner;
use App\Models\SiteSetting;
use Illuminate\Database\Seeder;

class LandingPageContentSeeder extends Seeder
{
    /**
     * Seed landing page static default content into database.
     */
    public function run(): void
    {
        $this->seedSiteSettings();
        $this->seedExplorationItems();
        $this->seedLibraryServices();
        $this->seedNewsItems();
        $this->seedFaqs();
        $this->seedPartners();
    }

    protected function seedSiteSettings(): void
    {
        $settings = [
            // 'hero_title' => 'Temukan Dunia Pengetahuan Tanpa Batas di Genggaman Mu.',
            'hero_description' => 'Perpustakaan Amarta menyediakan layanan informasi, koleksi cetak dan digital, serta fasilitas pembelajaran untuk menunjang kegiatan akademik dan pengembangan diri.',
            'hero_image' => '/img/gambar-utama-header.png',

            'section_explorasi_title' => 'Eksplorasi Perpustakaan Kami',
            'section_explorasi_description' => 'Dapatkan informasi lengkap tentang layanan dan fasilitas perpustakaan kami',
            'section_layanan_title' => 'Layanan Perpustakaan',
            'section_layanan_description' => 'Berkunjung dan nikmati berbagai layanan unggulan perpustakaan kami.',
            'section_berita_title' => 'Berita Terbaru',
            'section_berita_description' => 'Berita dan kegiatan terbaru di perpustakaan',
            'section_survei_title' => 'Survei Layanan',
            'section_survei_description' => 'Bantu kami meningkatkan kualitas layanan perpustakaan dengan mengisi survei secara singkat.',
            'section_survei_image' => '/img/responsive_layanan.png',
            'section_survei_button_text' => 'Mulai Survey',
            'section_faq_title' => 'FAQs',
            'section_faq_description' => 'Frequently asked questions',
            'section_partner_title' => 'Partner',
            'section_partner_description' => 'Terimakasih atas dukungan nya',

            'contact_map_url' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2259.7656427876145!2d108.32579047540595!3d-7.323217342945447!2m3!1f0!2f0!3f0!2m3!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6f5eba1b06f52f%3A0xaf882382d9de1508!2sPublic%20Vocational%20High%20School%201of%20Ciamis!5e1!3m2!1sen!2sid!4v1752055801083!5m2!1sen!2sid',
            'contact_place_name' => 'Jl. Jend. Sudirman Lingk. Cibeureum No.269, RT.01/RW.09, Sindangrasa, Kec. Ciamis, Kabupaten Ciamis, Jawa Barat 46215',
            'contact_email' => 'surat@smkn1cms.net',
            'contact_phone' => '+62 822-1584-6592',

            'footer_title' => 'Amarta K-One Ciamis',
            'footer_description' => 'Kami hadir untuk mendukung kegiatan literasi warga sekolah dengan berbagai informasi, layanan, dan koleksi buku.',
        ];

        foreach ($settings as $key => $value) {
            SiteSetting::query()->updateOrCreate([
                'key' => $key,
            ], [
                'value' => $value,
            ]);
        }
    }

    protected function seedExplorationItems(): void
    {
        $rows = [
            [
                'title' => 'Tentang Perpustakaan',
                'description' => 'Kenali sejarah dan koleksi unggulan kami',
                'image_url' => 'https://plus.unsplash.com/premium_photo-1681488394409-5614ef55488c?q=80&w=1064&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
                'link_url' => '/profil-perpustakaan#tentang',
                'sort_order' => 1,
            ],
            [
                'title' => 'Visi & Misi',
                'description' => 'Tujuan dan komitmen kami dalam melayani',
                'image_url' => 'https://images.unsplash.com/photo-1580537659466-0a9bfa916a54?q=80&w=387&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
                'link_url' => '/profil-perpustakaan#visi',
                'sort_order' => 2,
            ],
            [
                'title' => 'Struktur Organisasi',
                'description' => 'Bagaimana tim kami bekerja untuk Anda',
                'image_url' => 'https://images.unsplash.com/photo-1552664730-d307ca884978?q=80&w=870&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
                'link_url' => '/profil-perpustakaan#struktur',
                'sort_order' => 3,
            ],
            [
                'title' => 'Staff & Pustakawan',
                'description' => 'Tim profesional yang siap membantu Anda',
                'image_url' => 'https://images.unsplash.com/photo-1522202176988-66273c2fd55f?q=80&w=871&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
                'link_url' => '/profil-perpustakaan#staff',
                'sort_order' => 4,
            ],
            [
                'title' => 'Fasilitas',
                'description' => 'Temukan ruang dan layanan yang kami sediakan',
                'image_url' => 'https://images.unsplash.com/photo-1589998059171-988d887df646?q=80&w=876&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
                'link_url' => '/profil-perpustakaan#fasilitas',
                'sort_order' => 5,
            ],
            [
                'title' => 'Peraturan & Tata Tertib',
                'description' => 'Ketahui aturan penggunaan fasilitas',
                'image_url' => 'https://images.unsplash.com/photo-1494809610410-160faaed4de0?q=80&w=388&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
                'link_url' => '/profil-perpustakaan#peraturan',
                'sort_order' => 6,
            ],
        ];

        foreach ($rows as $row) {
            ExplorationItem::query()->updateOrCreate([
                'title' => $row['title'],
            ], [
                ...$row,
                'is_active' => true,
            ]);
        }
    }

    protected function seedLibraryServices(): void
    {
        $rows = [
            ['slug' => 'peminjaman-buku', 'title' => 'Peminjaman Buku', 'description' => 'Akses koleksi buku terlengkap dengan sistem peminjaman modern.', 'icon' => 'fas fa-book-open', 'sort_order' => 1],
            ['slug' => 'digital-library', 'title' => 'Digital Library', 'description' => 'Akses e-book dan jurnal digital dari mana saja.', 'icon' => 'fas fa-laptop', 'sort_order' => 2],
            ['slug' => 'layanan-konsultasi', 'title' => 'Layanan Konsultasi', 'description' => 'Konsultasi dengan pustakawan untuk bantuan penelitian.', 'icon' => 'fas fa-users', 'sort_order' => 3],
            ['slug' => 'akses-internet', 'title' => 'Akses Internet', 'description' => 'WiFi gratis berkecepatan tinggi untuk anggota.', 'icon' => 'fas fa-wifi', 'sort_order' => 4],
            ['slug' => 'pelatihan-literasi', 'title' => 'Pelatihan Literasi', 'description' => 'Workshop dan pelatihan keterampilan informasi.', 'icon' => 'fas fa-chalkboard-teacher', 'sort_order' => 5],
            ['slug' => 'ruang-baca', 'title' => 'Ruang Baca', 'description' => 'Ruang nyaman untuk membaca dan belajar.', 'icon' => 'fas fa-book-reader', 'sort_order' => 6],
        ];

        foreach ($rows as $row) {
            LibraryService::query()->updateOrCreate([
                'slug' => $row['slug'],
            ], [
                ...$row,
                'is_active' => true,
            ]);
        }
    }

    protected function seedNewsItems(): void
    {
        $rows = [
            ['title' => 'Peluncuran Sistem Baru Perpustakaan', 'excerpt' => 'Pembaruan sistem layanan perpustakaan untuk pengalaman yang lebih cepat dan efisien.', 'image_url' => 'https://plus.unsplash.com/premium_photo-1708287034839-2fcc5298cab7?q=80&w=870&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', 'published_at' => '2025-07-10 09:00:00'],
            ['title' => 'Kegiatan Literasi oleh Siswa Kelas X', 'excerpt' => 'Program literasi rutin untuk meningkatkan minat baca siswa.', 'image_url' => 'https://images.unsplash.com/photo-1521587760476-6c12a4b040da?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80', 'published_at' => '2025-07-08 09:00:00'],
            ['title' => 'Workshop Digital Library untuk Guru', 'excerpt' => 'Pelatihan pemanfaatan koleksi digital untuk pendidik.', 'image_url' => 'https://images.unsplash.com/photo-1523240795612-9a054b0db644?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80', 'published_at' => '2025-07-05 09:00:00'],
            ['title' => 'Pembukaan Pojok Baca Baru', 'excerpt' => 'Perpustakaan membuka area baca baru yang lebih nyaman.', 'image_url' => 'https://images.unsplash.com/photo-1481627834876-b7833e8f5570?auto=format&fit=crop&w=900&q=80', 'published_at' => '2025-07-01 09:00:00'],
            ['title' => 'Donasi Buku dari Alumni 2020', 'excerpt' => 'Kontribusi alumni menambah koleksi bacaan sekolah.', 'image_url' => 'https://images.unsplash.com/photo-1497633762265-9d179a990aa6?auto=format&fit=crop&w=900&q=80', 'published_at' => '2025-06-28 09:00:00'],
            ['title' => 'Perpustakaan Juara Lomba Nasional', 'excerpt' => 'Prestasi perpustakaan dalam ajang lomba tingkat nasional.', 'image_url' => 'https://images.unsplash.com/photo-1512820790803-83ca734da794?auto=format&fit=crop&w=900&q=80', 'published_at' => '2025-06-25 09:00:00'],
            ['title' => 'Pelatihan Penggunaan Katalog Digital', 'excerpt' => 'Siswa dibimbing untuk memanfaatkan katalog digital secara efektif.', 'image_url' => 'https://images.unsplash.com/photo-1456324504439-367cee3b3c32?auto=format&fit=crop&w=900&q=80', 'published_at' => '2025-06-20 09:00:00'],
        ];

        foreach ($rows as $row) {
            NewsItem::query()->updateOrCreate([
                'title' => $row['title'],
            ], [
                ...$row,
                'is_active' => true,
            ]);
        }
    }

    protected function seedFaqs(): void
    {
        $rows = [
            ['question' => 'Bagaimana cara meminjam buku di perpustakaan?', 'answer' => 'Siswa cukup membawa kartu anggota dan memilih buku yang ingin dipinjam, lalu mencatat di bagian peminjaman.', 'sort_order' => 1],
            ['question' => 'Berapa lama durasi peminjaman buku?', 'answer' => 'Umumnya 7–14 hari, tergantung kebijakan sekolah. Bisa diperpanjang jika belum ada pemesan.', 'sort_order' => 2],
            ['question' => 'Apa yang harus dilakukan jika buku hilang atau rusak?', 'answer' => 'Siswa harus melapor ke petugas perpustakaan dan mengganti buku sesuai kebijakan.', 'sort_order' => 3],
            ['question' => 'Apakah bisa meminjam lebih dari satu buku?', 'answer' => 'Ya, biasanya maksimal 2-3 buku dalam satu waktu.', 'sort_order' => 4],
            ['question' => 'Bolehkah membawa tas atau makanan ke dalam perpustakaan?', 'answer' => 'Tidak. Biasanya tas dititipkan dan makanan/minuman tidak diperbolehkan demi menjaga kebersihan.', 'sort_order' => 5],
            ['question' => 'Apakah perpustakaan menyediakan layanan digital atau e-book?', 'answer' => 'Beberapa sekolah sudah menyediakan akses ke e-book atau digilib, tergantung fasilitas perpustakaannya.', 'sort_order' => 6],
        ];

        foreach ($rows as $row) {
            Faq::query()->updateOrCreate([
                'question' => $row['question'],
            ], [
                ...$row,
                'is_active' => true,
            ]);
        }
    }

    protected function seedPartners(): void
    {
        $rows = [
            ['name' => 'OSIS SMKN 1 CIAMIS', 'logo_url' => '/img/logoosisnobg.png', 'sort_order' => 1],
            ['name' => 'KIR', 'logo_url' => '/img/logokirnobg.png', 'sort_order' => 2],
            ['name' => 'RPL', 'logo_url' => '/img/logorplnobg.png', 'sort_order' => 3],
            ['name' => 'MPLB', 'logo_url' => '/img/logomplbnobg.png', 'sort_order' => 4],
            ['name' => 'SMKN 1 CIAMIS', 'logo_url' => '/img/logoSmeaNoBg.png', 'sort_order' => 5],
        ];

        foreach ($rows as $row) {
            Partner::query()->updateOrCreate([
                'name' => $row['name'],
            ], [
                ...$row,
                'is_active' => true,
            ]);
        }
    }
}
