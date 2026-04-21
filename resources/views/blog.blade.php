<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>Blog AmartaLib</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body class="font-inter bg-gray-50">
    @include('layouts/partials/navbar')
    <section class="px-6 py-16 max-w-7xl mx-auto">
        <!-- Hero Header -->
        <div class="my-12 text-center">
            <h1 class="font-playfair bg-gradient-to-r from-hijau-light to-biru-light bg-clip-text text-transparent text-4xl md:text-5xl font-bold mt-3 mb-4">Berita & Informasi</h1>
            <p class="text-gray-500 max-w-2xl mx-auto text-lg">Temukan update terbaru dan artikel menarik dari perpustakaan kami</p>
        </div>
        <div class="breadcrumbs text-sm mb-7">
            <ul class="text-black">
                <li><a href="/">Beranda</a></li>
                <li><a href="/blog-perpustakaan">Blog</a></li>
            </ul>
        </div>
        <!-- Search and Filter Section -->
        <div class="bg-gray-50 shadow-[0_4px_20px_rgba(0,0,0,0.05)] rounded-xl p-6 mb-12 transition-all duration-300 hover:shadow-[0_6px_25px_rgba(0,0,0,0.08)]">
            <div class="flex flex-col md:flex-row gap-4 items-center justify-between">
                <!-- Search Input -->
                <div class="relative w-full md:w-2/3">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-search text-gray-400"></i>
                    </div>
                    <input type="text" class="transition-all bg-white duration-300 block w-full pl-10 pr-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-1 focus:ring-hijau-light text-gray-700 placeholder-gray-400 focus:border-green-500 focus:shadow-[0_0_0_3px_rgba(16,185,129,0.1)]"
                        placeholder="Cari berita atau informasi...">
                </div>

                <!-- Category Filter -->
                <div class="w-full md:w-1/3 flex flex-wrap md:flex-nowrap gap-3">
                    <select class="transition-all duration-200 flex-grow px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-1 focus:ring-hijau-light text-gray-700 appearance-none bg-white bg-[url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIGhlaWdodD0iMTYiIHZpZXdCb3g9IjAgMCAyNCAyNCIgd2lkdGg9IjE2Ij48cGF0aCBmaWxsPSJjdXJyZW50Q29sb3IiIGQ9Ik83IDEwbDUgNSA1LTV6Ii8+PC9zdmc+')] bg-no-repeat bg-[right_0.75rem_center] hover:-translate-y-0.5">
                        <option value="">Semua Kategori</option>
                        <option value="berita">Berita</option>
                        <option value="pengumuman">Pengumuman</option>
                        <option value="event">Event</option>
                        <option value="prestasi">Prestasi</option>
                        <option value="teknologi">Teknologi</option>
                        <option value="kegiatan">Kegiatan</option>
                    </select>

                    <button class="transition-all duration-200 px-4 py-3 bg-hijau-dark text-white rounded-lg hover:bg-hijau-darker whitespace-nowrap hover:-translate-y-0.5">
                        <i class="fas fa-filter mr-2"></i> Filter
                    </button>
                </div>
            </div>

            <!-- Applied Filters -->
            <div class="mt-4 flex flex-wrap gap-2 hidden" id="applied-filters">
                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-hijau-light text-white">
                    Berita
                    <button class="ml-1.5 inline-flex items-center justify-center w-4 h-4 rounded-full hover:bg-white/20">
                        <i class="fas fa-times text-xs"></i>
                    </button>
                </span>
                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                    Terbaru
                    <button class="ml-1.5 inline-flex items-center justify-center w-4 h-4 rounded-full hover:bg-blue-200">
                        <i class="fas fa-times text-xs"></i>
                    </button>
                </span>
            </div>
        </div>

        <!-- News Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- News Card 1 -->
            <article class="bg-white rounded-xl overflow-hidden group transition-all duration-300 shadow-sm hover:shadow-lg hover:-translate-y-1">
                <div class="relative overflow-hidden h-48">
                    <img src="https://images.unsplash.com/photo-1499750310107-5fef28a66643?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1170&q=80"
                        alt="berita"
                        class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105" />
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                    <span class="absolute top-4 right-4 bg-white/90 text-xs font-medium py-1 px-2 rounded text-hijau-dark">Berita</span>
                </div>
                <div class="p-6">
                    <div class="flex items-center text-sm text-gray-500 mb-3">
                        <span><i class="far fa-calendar-alt mr-1"></i> 08 Juli 2025</span>
                        <span class="mx-2">•</span>
                        <span><i class="far fa-user mr-1"></i> Admin</span>
                    </div>
                    <h2 class="font-bold text-xl mb-3 group-hover:text-green-600 transition-colors text-hijau-dark">Workshop Literasi Digital untuk Meningkatkan Minat Baca</h2>
                    <p class="text-gray-600 mb-4 line-clamp-3">Perpustakaan kami menyelenggarakan workshop literasi digital untuk membantu siswa memahami cara memanfaatkan sumber daya digital secara efektif.</p>
                    <a href="#" class="inline-flex items-center text-green-600 font-medium group-hover:text-green-700 transition-colors">
                        Baca Selengkapnya
                        <i class="fas fa-arrow-right ml-2 transition-transform group-hover:translate-x-1"></i>
                    </a>
                </div>
            </article>

            <!-- News Card 2 -->
            <article class="bg-white rounded-xl overflow-hidden group transition-all duration-300 shadow-sm hover:shadow-lg hover:-translate-y-1">
                <div class="relative overflow-hidden h-48">
                    <img src="https://images.unsplash.com/photo-1524995997946-a1c2e315a42f?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1170&q=80"
                        alt="berita"
                        class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105" />
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                    <span class="absolute top-4 right-4 bg-white/90 text-xs font-medium py-1 px-2 rounded text-hijau-dark">Pengumuman</span>
                </div>
                <div class="p-6">
                    <div class="flex items-center text-sm text-gray-500 mb-3">
                        <span><i class="far fa-calendar-alt mr-1"></i> 05 Juli 2025</span>
                        <span class="mx-2">•</span>
                        <span><i class="far fa-user mr-1"></i> Kepala Perpus</span>
                    </div>
                    <h2 class="font-bold text-xl mb-3 group-hover:text-green-600 transition-colors text-hijau-dark">Penambahan Koleksi Buku Terbaru Semester Ini</h2>
                    <p class="text-gray-600 mb-4 line-clamp-3">Kami dengan bangga mengumumkan penambahan 250 judul buku baru yang mencakup berbagai bidang ilmu untuk mendukung pembelajaran.</p>
                    <a href="#" class="inline-flex items-center text-green-600 font-medium group-hover:text-green-700 transition-colors">
                        Baca Selengkapnya
                        <i class="fas fa-arrow-right ml-2 transition-transform group-hover:translate-x-1"></i>
                    </a>
                </div>
            </article>

            <!-- News Card 3 -->
            <article class="bg-white rounded-xl overflow-hidden group transition-all duration-300 shadow-sm hover:shadow-lg hover:-translate-y-1">
                <div class="relative overflow-hidden h-48">
                    <img src="https://images.unsplash.com/photo-1523240795612-9a054b0db644?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1170&q=80"
                        alt="berita"
                        class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105" />
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                    <span class="absolute top-4 right-4 bg-white/90 text-xs font-medium py-1 px-2 rounded text-hijau-dark">Event</span>
                </div>
                <div class="p-6">
                    <div class="flex items-center text-sm text-gray-500 mb-3">
                        <span><i class="far fa-calendar-alt mr-1"></i> 01 Juli 2025</span>
                        <span class="mx-2">•</span>
                        <span><i class="far fa-user mr-1"></i> Tim Event</span>
                    </div>
                    <h2 class="font-bold text-xl mb-3 group-hover:text-green-600 transition-colors text-hijau-dark">Book Fair 2025: Temukan Buku Favoritmu dengan Diskon Spesial</h2>
                    <p class="text-gray-600 mb-4 line-clamp-3">Jangan lewatkan Book Fair tahunan kami yang akan diselenggarakan pada 15-20 Juli 2025 dengan berbagai diskon dan acara menarik.</p>
                    <a href="#" class="inline-flex items-center text-green-600 font-medium group-hover:text-green-700 transition-colors">
                        Baca Selengkapnya
                        <i class="fas fa-arrow-right ml-2 transition-transform group-hover:translate-x-1"></i>
                    </a>
                </div>
            </article>

            <!-- News Card 4 -->
            <article class="bg-white rounded-xl overflow-hidden group transition-all duration-300 shadow-sm hover:shadow-lg hover:-translate-y-1">
                <div class="relative overflow-hidden h-48">
                    <img src="https://images.unsplash.com/photo-1521587760476-6c12a4b040da?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1170&q=80"
                        alt="berita"
                        class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105" />
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                    <span class="absolute top-4 right-4 bg-white/90 text-xs font-medium py-1 px-2 rounded text-hijau-dark">Prestasi</span>
                </div>
                <div class="p-6">
                    <div class="flex items-center text-sm text-gray-500 mb-3">
                        <span><i class="far fa-calendar-alt mr-1"></i> 28 Juni 2025</span>
                        <span class="mx-2">•</span>
                        <span><i class="far fa-user mr-1"></i> Tim Redaksi</span>
                    </div>
                    <h2 class="font-bold text-xl mb-3 group-hover:text-green-600 transition-colors text-hijau-dark">Perpustakaan Kami Raih Penghargaan Nasional</h2>
                    <p class="text-gray-600 mb-4 line-clamp-3">Perpustakaan SMKN 1 Ciamis meraih penghargaan "Perpustakaan Sekolah Terinovatif" tingkat nasional tahun 2025.</p>
                    <a href="#" class="inline-flex items-center text-green-600 font-medium group-hover:text-green-700 transition-colors">
                        Baca Selengkapnya
                        <i class="fas fa-arrow-right ml-2 transition-transform group-hover:translate-x-1"></i>
                    </a>
                </div>
            </article>

            <!-- News Card 5 -->
            <article class="bg-white rounded-xl overflow-hidden group transition-all duration-300 shadow-sm hover:shadow-lg hover:-translate-y-1">
                <div class="relative overflow-hidden h-48">
                    <img src="https://images.unsplash.com/photo-1521737604893-d14cc237f11d?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1184&q=80"
                        alt="berita"
                        class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105" />
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                    <span class="absolute top-4 right-4 bg-white/90 text-xs font-medium py-1 px-2 rounded text-hijau-dark">Teknologi</span>
                </div>
                <div class="p-6">
                    <div class="flex items-center text-sm text-gray-500 mb-3">
                        <span><i class="far fa-calendar-alt mr-1"></i> 25 Juni 2025</span>
                        <span class="mx-2">•</span>
                        <span><i class="far fa-user mr-1"></i> IT Support</span>
                    </div>
                    <h2 class="font-bold text-xl mb-3 group-hover:text-green-600 transition-colors text-hijau-dark">Sistem Peminjaman Buku Online Resmi Diluncurkan</h2>
                    <p class="text-gray-600 mb-4 line-clamp-3">Kini Anda bisa meminjam buku secara online melalui platform digital kami yang baru saja diluncurkan.</p>
                    <a href="#" class="inline-flex items-center text-green-600 font-medium group-hover:text-green-700 transition-colors">
                        Baca Selengkapnya
                        <i class="fas fa-arrow-right ml-2 transition-transform group-hover:translate-x-1"></i>
                    </a>
                </div>
            </article>

            <!-- News Card 6 -->
            <article class="bg-white rounded-xl overflow-hidden group transition-all duration-300 shadow-sm hover:shadow-lg hover:-translate-y-1">
                <div class="relative overflow-hidden h-48">
                    <img src="https://images.unsplash.com/photo-1501504905252-473c47e087f8?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1074&q=80"
                        alt="berita"
                        class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105" />
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                    <span class="absolute top-4 right-4 bg-white/90 text-xs font-medium py-1 px-2 rounded text-hijau-dark">Kegiatan</span>
                </div>
                <div class="p-6">
                    <div class="flex items-center text-sm text-gray-500 mb-3">
                        <span><i class="far fa-calendar-alt mr-1"></i> 20 Juni 2025</span>
                        <span class="mx-2">•</span>
                        <span><i class="far fa-user mr-1"></i> Humas</span>
                    </div>
                    <h2 class="font-bold text-xl mb-3 group-hover:text-green-600 transition-colors text-hijau-dark">Kunjungan Studi dari Perpustakaan Daerah</h2>
                    <p class="text-gray-600 mb-4 line-clamp-3">Perpustakaan Daerah Kabupaten Ciamis melakukan kunjungan studi untuk belajar tentang manajemen perpustakaan sekolah.</p>
                    <a href="#" class="inline-flex items-center text-green-600 font-medium group-hover:text-green-700 transition-colors">
                        Baca Selengkapnya
                        <i class="fas fa-arrow-right ml-2 transition-transform group-hover:translate-x-1"></i>
                    </a>
                </div>
            </article>
        </div>

        <!-- Pagination -->
        <div class="mt-16 flex justify-center">
            <nav class="flex items-center space-x-2">
                <button class="w-10 h-10 hover:bg-hijau-dark flex items-center justify-center rounded-full border border-gray-200 bg-hijau-light hover:text-green-600 transition-colors">
                    <i class="fas fa-chevron-left text-white"></i>
                </button>
                <button class="w-10 h-10 flex items-center justify-center rounded-full bg-hijau-dark text-white font-medium">1</button>
                <button class="w-10 h-10 bg-hijau-light flex items-center justify-center rounded-full border border-gray-200 hover:bg-green-200 hover:text-green-600 transition-colors">2</button>
                <button class="w-10 h-10 bg-hijau-light flex items-center justify-center rounded-full border border-gray-200 hover:bg-green-200 hover:text-green-600 transition-colors">3</button>
                <span class="px-2 text-gray-800">...</span>
                <button class="w-10 h-10 bg-hijau-light flex items-center justify-center rounded-full border border-gray-200 hover:bg-green-200 hover:text-green-600 transition-colors">8</button>
                <button class="w-10 h-10 hover:bg-hijau-dark flex items-center justify-center rounded-full border border-gray-200 bg-hijau-light hover:text-green-600 transition-colors">
                    <i class="fas fa-chevron-right text-white"></i>
                </button>
            </nav>
        </div>
    </section>
</body>

</html>