<!DOCTYPE html>
<html lang="en">
{{-- Pemilik : Kahla Luthfiyah Halim
    Tanggal upload awal : 21 April 2026
    Ada copyright di dalamnya, jangan dihapus atau diganti tanpa izin.
    --}}

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>AmartaLib</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Icons -->
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <style>
        /* Hide scrollbar but keep functionality */
        .no-scrollbar::-webkit-scrollbar {
            display: none;
        }

        .no-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }

        .slider-container {
            position: relative;
            overflow: hidden;
        }

        .slider-track {
            display: flex;
            transition: transform 0.5s ease-in-out;
        }

        .slider-item {
            flex: 0 0 100%;
        }

        @media (min-width: 768px) {
            .slider-item {
                flex: 0 0 50%;
            }
        }

        @media (min-width: 1024px) {
            .slider-item {
                flex: 0 0 33.333%;
            }
        }
    </style>
</head>

<body class="bg-white text-gray-900 transition-colors duration-300">
    @include('layouts/partials/navbar')
    @if (session('feedback_submitted'))
        <div class="max-w-screen-xl mx-auto mt-24 px-4 sm:px-6">
            <div class="rounded-lg bg-green-50 text-green-700 px-4 py-3 text-sm">
                Terima kasih! Saran dan masukan Anda sudah kami terima.
            </div>
        </div>
    @endif
    <!-- Hero Utama -->
    <section class="pt-20 pb-12 px-4 sm:px-6">
        <div class="max-w-screen-xl mx-auto bg-white">
            <div class="grid grid-cols-1 sm:grid-cols-2 items-center gap-8 lg:gap-10 px-4 sm:px-8 lg:px-12 py-10 sm:py-16">
                <div class="max-w-xl">
                    @php
                        $heroTitlePlain = trim(preg_replace('/\s+/u', ' ', str_replace(["\r\n", "\n", "\r"], ' ', (string) ($siteSettings['hero_title'] ?? 'Temukan Dunia Pengetahuan Tanpa Batas di Genggaman Mu.'))));

                        $desktopHeroTitle = $heroTitlePlain;
                        $mobileHeroTitle = $heroTitlePlain;

                        if (str_contains($heroTitlePlain, 'Temukan Dunia') && str_contains($heroTitlePlain, 'Pengetahuan Tanpa') && str_contains($heroTitlePlain, 'Batas di Genggaman Mu.')) {
                            $desktopHeroTitle = "Temukan Dunia\nPengetahuan Tanpa\nBatas di Genggaman Mu.";
                            $mobileHeroTitle = "Temukan Dunia\nPengetahuan\nTanpa Batas di\nGenggaman Mu.";
                        }

                        $desktopHeroTitleHtml = nl2br(str_replace('Batas di Genggaman Mu.', 'Batas&nbsp;di&nbsp;Genggaman&nbsp;Mu.', e($desktopHeroTitle)));
                        $mobileHeroTitleHtml = nl2br(str_replace('Genggaman Mu.', 'Genggaman&nbsp;Mu.', e($mobileHeroTitle)));
                    @endphp
                    <h1 class="hidden sm:block text-4xl lg:text-5xl font-bold text-[#031C62] leading-[1.35] mb-6 sm:mb-8">
                        {!! $desktopHeroTitleHtml !!}
                    </h1>
                    <h1 class="sm:hidden text-3xl font-bold text-[#031C62] leading-[1.35] mb-6 sm:mb-8">
                        {!! $mobileHeroTitleHtml !!}
                    </h1>
                    <p class="text-[#1E3A7A] text-lg leading-relaxed max-w-lg mb-8">
                        {{ $siteSettings['hero_description'] ?? 'Perpustakaan Amarta menyediakan layanan informasi, koleksi cetak dan digital, serta fasilitas pembelajaran untuk menunjang kegiatan akademik dan pengembangan diri.' }}
                    </p>
                    <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3 sm:gap-4">
                        <a href="/profil-perpustakaan"
                            class="inline-flex w-full sm:w-auto items-center justify-center px-7 py-3 rounded-md bg-[#031C62] text-white font-medium hover:bg-[#021547] transition-colors duration-300">
                            Jelajahi
                        </a>
                        <a href="/daftar-keanggotaan"
                            class="inline-flex w-full sm:w-auto items-center justify-center px-7 py-3 rounded-md border border-[#031C62] text-[#031C62] font-medium hover:bg-[#031C62] hover:text-white transition-colors duration-300">
                            Daftar Keanggotaan
                        </a>
                    </div>
                </div>

                <div class="hidden sm:flex justify-center lg:justify-end">
                    <img src="{{ $siteSettings['hero_image'] ?? asset('img/gambar-utama-header.png') }}"
                        alt="Ilustrasi utama perpustakaan" class="w-full max-w-[460px] h-auto object-contain"
                        onerror="this.src='{{ asset('img/gambar-utama-header.png') }}'">
                </div>
            </div>
        </div>
    </section>

    <!-- Profil -->
    <section class="py-20 bg-gradient-to-b from-green-50 to-white">
        <div class="container max-w-screen-xl mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="text-4xl font-bold text-hijau-light mb-4">
                    {{ $siteSettings['section_explorasi_title'] ?? 'Eksplorasi Perpustakaan Kami' }}</h2>
                <p class="text-lg text-hijau-dark max-w-2xl mx-auto">
                    {{ $siteSettings['section_explorasi_description'] ?? 'Dapatkan informasi lengkap tentang layanan dan fasilitas perpustakaan kami' }}
                </p>
            </div>

            <div class="slider-container">
                <div class="slider-track" id="profileCards">
                    @forelse ($explorationItems as $explore)
                        <div class="slider-item flex-shrink-0">
                            <div
                                class="group m-4 relative overflow-hidden rounded-xl shadow-lg h-80 transition-all duration-500 hover:shadow-xl">
                                <img src="{{ $explore->image_url ?: asset('img/gambar-utama-header.png') }}"
                                    onerror="this.src='/img/gambar-utama-header.png'"
                                    class="w-full h-full object-cover transition-all duration-500 group-hover:scale-105 group-hover:blur-sm">
                                <div
                                    class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/40 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex flex-col justify-end p-6">
                                    <h3
                                        class="text-2xl font-bold text-white mb-2 translate-y-4 group-hover:translate-y-0 transition-transform duration-300">
                                        {{ $explore->title }}
                                    </h3>
                                    <p
                                        class="text-blue-100 mb-4 opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                                        {{ $explore->description }}
                                    </p>
                                    <a href="{{ $explore->link_url ?: '#' }}"
                                        class="self-start hover:text-blue-400 text-white py-2 rounded-lg text-sm font-medium transition-all duration-300 opacity-0 group-hover:opacity-100 translate-y-4 group-hover:translate-y-0">
                                        Selengkapnya →
                                    </a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="slider-item flex-shrink-0">
                            <div class="m-4 rounded-xl border border-slate-200 p-6 text-sm text-slate-500">
                                Data eksplorasi belum tersedia.
                            </div>
                        </div>
                    @endforelse
                </div>

                <button id="prevSlideBtn" type="button" aria-label="Slide sebelumnya"
                    class="absolute left-2 md:left-4 top-1/2 -translate-y-1/2 z-20 w-10 h-10 rounded-full bg-white/90 hover:bg-white text-[#031C62] shadow-md transition-all duration-300 flex items-center justify-center">
                    <i class="fas fa-chevron-left text-sm"></i>
                </button>

                <button id="nextSlideBtn" type="button" aria-label="Slide berikutnya"
                    class="absolute right-2 md:right-4 top-1/2 -translate-y-1/2 z-20 w-10 h-10 rounded-full bg-white/90 hover:bg-white text-[#031C62] shadow-md transition-all duration-300 flex items-center justify-center">
                    <i class="fas fa-chevron-right text-sm"></i>
                </button>
            </div>

            <!-- Navigation Dots -->
            <div class="flex justify-center mt-6 space-x-2" id="sliderDots"></div>
        </div>
    </section>

    <!-- Layanan Perpustakaan -->
    <section id="layanan" class="py-16 relative overflow-hidden bg-white">
        <!-- Header Section -->
        <div class="max-w-screen-xl container mx-auto px-4">
            <div class="text-left">
                <h2 class="text-3xl font-bold md:text-4xl text-hijau-light mb-4">
                    {{ $siteSettings['section_layanan_title'] ?? 'Layanan Perpustakaan' }}</h2>
                <p class="text-md text-hijau-dark max-w-2xl mb-12">
                    {{ $siteSettings['section_layanan_description'] ?? 'Berkunjung dan nikmati berbagai layanan unggulan perpustakaan kami.' }}
                </p>
            </div>

            <!-- Grid Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse ($libraryServices as $service)
                    <div
                        class="bg-white rounded-lg p-6 shadow-md transition-all duration-300 border border-gray-100 hover:scale-105 hover:shadow-lg">
                        <div class="flex items-start">
                            <div class="text-4xl mb-4 text-hijau-light mr-4">
                                <i class="{{ $service->icon ?: 'fas fa-book-open' }}"></i>
                            </div>
                            <div>
                                <h3 class="text-xl font-bold mb-2 text-hijau-dark">{{ $service->title }}</h3>
                                <p class="text-gray-600 text-sm">{{ $service->description }}</p>
                                <a href="{{ route('layanan-detail', $service->slug) }}"
                                    class="mt-4 text-hijau-light hover:text-hijau-dark transition flex items-center text-sm">
                                    Lihat Detail <i class="fas fa-arrow-right ml-2"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full rounded-lg border border-slate-200 p-6 text-sm text-slate-500">
                        Data layanan belum tersedia.
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- berita -->
    <section class="py-16 bg-white">
        <div class="max-w-screen-xl mx-auto px-4 sm:px-6">
            <div class="flex flex-col sm:flex-row justify-between sm:items-center gap-4 mb-8">
                <div>
                    <h2 class="text-3xl font-bold md:text-4xl text-hijau-light mb-4">
                        {{ $siteSettings['section_berita_title'] ?? 'Berita Terbaru' }}</h2>
                    <p class="text-gray-600 text-md">
                        {{ $siteSettings['section_berita_description'] ?? 'Berita dan kegiatan terbaru di perpustakaan' }}
                    </p>
                </div>
                <a href="{{ route('blog-perpustakaan') }}"
                    class="text-sm font-semibold text-blue-600 hover:underline">Lihat Semua</a>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                <!-- Featured -->
                <div class="md:col-span-2 h-[370px] relative rounded-xl overflow-hidden shadow-lg">
                    <img src="{{ $featuredNews?->image_url ?: 'https://plus.unsplash.com/premium_photo-1708287034839-2fcc5298cab7?q=80&w=870&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D' }}"
                        alt="{{ $featuredNews?->title ?: 'Featured News' }}" class="w-full h-full object-cover">
                    <div
                        class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent p-6 flex flex-col justify-end">
                        <span class="text-sm text-white mb-1">Featured</span>
                        <h3 class="text-white text-2xl font-bold mb-1">
                            {{ $featuredNews?->title ?: 'Belum ada berita unggulan' }}</h3>
                        <p class="text-gray-300 text-sm">
                            {{ $featuredNews?->published_at?->translatedFormat('d F Y') ?: '-' }}</p>
                    </div>
                </div>

                <!-- Scrollable Side list -->
                <div class="relative">
                    <div
                        class="absolute inset-0 pointer-events-none z-10 shadow-[inset_0_-20px_20px_-15px_rgba(255,255,255,1)]">
                    </div>
                    <div
                        class="space-y-4 overflow-y-auto max-h-[370px] pr-2 scrollbar-thin scrollbar-thumb-gray-300 scrollbar-track-gray-100 hover:scrollbar-thumb-gray-400">
                        @forelse ($sideNews as $news)
                            <div class="flex gap-3 p-3 rounded-lg hover:bg-gray-50 transition cursor-pointer">
                                <img src="{{ $news->image_url }}" alt="{{ $news->title }}"
                                    class="w-16 h-16 rounded-md object-cover flex-shrink-0">
                                <div class="min-w-0 flex-1">
                                    <h4 class="font-semibold text-gray-800 text-sm leading-snug line-clamp-2">
                                        {{ $news->title }}</h4>
                                    <p class="text-xs text-gray-500 mt-1">
                                        {{ $news->published_at?->translatedFormat('d F Y') ?: '-' }}</p>
                                </div>
                            </div>
                        @empty
                            <div class="text-sm text-slate-500 p-3">Belum ada daftar berita.</div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Survei layanan -->
    <section class="bg-[#fff] overflow-hidden">
    <div class="max-w-screen-xl mx-auto px-4 sm:px-6 md:px-10 lg:px-14">
            <div class="grid grid-cols-1 lg:grid-cols-2 items-center gap-10 lg:gap-16">
                <div class="text-center lg:text-left max-w-xl">
                    <h2 class="text-3xl font-bold md:text-4xl text-hijau-light mb-5">
                        {{ $siteSettings['section_survei_title'] ?? 'Survei Layanan' }}</h2>
                    <p class="text-[#1E3A7A] text-lg leading-relaxed mb-8">
                        {{ $siteSettings['section_survei_description'] ?? 'Bantu kami meningkatkan kualitas layanan perpustakaan dengan mengisi survei secara singkat.' }}
                    </p>
                    <a href="{{ route('survei-layanan') }}"
                        class="inline-flex items-center justify-center px-7 py-3 rounded-lg bg-[#031C62] text-white font-medium hover:bg-[#021547] transition-colors duration-300">
                        {{ $siteSettings['section_survei_button_text'] ?? 'Mulai Survey' }}
                    </a>
                </div>

                <div class="flex justify-center lg:justify-end">
                    <img src="{{ $siteSettings['section_survei_image'] ?? asset('img/responsive_layanan.png') }}"
                        alt="Ilustrasi layanan survei responsif" onerror="this.src='/img/responsive_layanan.png'"
                        class="w-full max-w-[620px] h-auto object-contain">
                </div>
            </div>
        </div>
    </section>

    <!-- Faqs -->
    <section class="relative ring-1 ring-gray-900/5 max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8 py-12 sm:rounded-lg">
        <div class="flex flex-col lg:flex-row gap-8">
            <!-- Bagian Kiri (FAQ) -->
            <div class="lg:w-2/3">
                <div class="flex flex-col items-start">
                    <h2 class="text-hijau-light text-3xl font-bold tracking-tight md:text-4xl">
                        {{ $siteSettings['section_faq_title'] ?? 'FAQs' }}</h2>
                    <p class="mt-3 text-lg text-hijau-dark md:text-xl">
                        {{ $siteSettings['section_faq_description'] ?? 'Frequently asked questions' }}</p>
                </div>
                <div class="mt-8 space-y-4">
                    @forelse ($faqs as $faq)
                        <div class="py-5">
                            <details class="group faq-item">
                                <summary
                                    class="flex text-gray-800 cursor-pointer list-none items-center justify-between font-medium">
                                    <span class="text-hijau-dark">{{ $faq->question }}</span>
                                    <span class="transition-transform duration-300 group-open:rotate-180">
                                        <svg fill="none" height="24" shape-rendering="geometricPrecision"
                                            stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="1.5" viewBox="0 0 24 24" width="24">
                                            <path d="M6 9l6 6 6-6"></path>
                                        </svg>
                                    </span>
                                </summary>
                                <div
                                    class="grid grid-rows-[0fr] transition-[grid-template-rows] duration-500 ease-in-out group-open:grid-rows-[1fr]">
                                    <div class="overflow-hidden">
                                        <p
                                            class="mt-3 text-hijau-light opacity-0 transition-opacity duration-300 delay-100 group-open:opacity-100">
                                            {{ $faq->answer }}
                                        </p>
                                    </div>
                                </div>
                            </details>
                        </div>
                    @empty
                        <div class="py-5 text-sm text-slate-500">FAQ belum tersedia.</div>
                    @endforelse
                </div>
            </div>

            <!-- Bagian Kanan (Deskripsi) -->
            <div class="lg:w-1/3 mt-8 lg:mt-32 px-4 lg:px-0">
                <div class="space-y-4 bg-gray-50 p-6 rounded-lg">
                    <h3 class="text-lg md:text-xl font-semibold text-hijau-dark">Anda memiliki pertanyaan seputar
                        perpustakaan kami?</h3>
                    <p class="text-hijau-dark text-sm md:text-base">Cek jawaban anda di beberapa pertanyaan yang sering
                        ditanyakan.</p>
                    <p class="text-hijau-dark text-sm md:text-base">Pertanyaan anda masih belum terjawab? <span
                            class="text-hijau-light">Hubungi petugas perpustakaan kami.</span></p>
                    <a href="#survei-layanan"
                        class="inline-block px-6 py-2 md:px-8 md:py-3 text-white text-sm md:text-base font-semibold rounded-lg shadow-lg bg-hijau-light hover:bg-hijau-dark transition duration-300 transform hover:-translate-y-1">
                        Chat Bot
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- partner -->
    <section class="py-24 bg-white">
        <div class="container mx-auto px-4 max-w-screen-xl">
            <h3 class="text-center text-2xl font-semibold tracking-widest text-hijau-light">
                {{ $siteSettings['section_partner_title'] ?? 'Partner' }}</h3>
            <p class="text-hijau-dark text-center ml-auto mb-8">
                {{ $siteSettings['section_partner_description'] ?? 'Terimakasih atas dukungan nya' }}</p>
            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-6 sm:gap-8 items-center">
                @forelse ($partners as $partner)
                    <div class="flex justify-center px-2 sm:px-4 md:px-6">
                        <img src="{{ $partner->logo_url ?: asset('img/logoamarta.png') }}" alt="{{ $partner->name }}"
                            onerror="this.src='/img/logoamarta.png'"
                            class="h-32 object-contain grayscale hover:grayscale-0 transition-all duration-300">
                    </div>
                @empty
                    <p class="text-sm text-slate-500">Data partner belum tersedia.</p>
                @endforelse
            </div>
        </div>
    </section>

    <!-- feedback/contact -->
    <section id="kontak" class="text-gray-600 body-font relative">
    <div class="container max-w-screen-xl px-4 sm:px-5 py-16 sm:py-24 mx-auto flex flex-wrap lg:flex-nowrap">
            <div
        class="lg:w-2/3 md:w-1/2 bg-gray-300 rounded-lg overflow-hidden sm:mr-10 p-4 sm:p-8 lg:p-10 flex items-end justify-start relative">
                <iframe width="100%" height="100%" class="absolute inset-0" frameborder="0" title="map"
                    marginheight="0" marginwidth="0" scrolling="no"
                    src="{{ $siteSettings['contact_map_url'] ?? 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2259.7656427876145!2d108.32579047540595!3d-7.323217342945447!2m3!1f0!2f0!3f0!2m3!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6f5eba1b06f52f%3A0xaf882382d9de1508!2sPublic%20Vocational%20High%20School%201of%20Ciamis!5e1!3m2!1sen!2sid!4v1752055801083!5m2!1sen!2sid' }}"
                    style="filter: grayscale(1) contrast(1.2) opacity(0.4);"></iframe>
                <div class="bg-white relative flex flex-wrap py-6 rounded shadow-md">
                    <div class="lg:w-1/2 px-6">
                        <h2 class="title-font font-semibold text-gray-900 tracking-widest text-xs">ALAMAT</h2>
                        <p class="mt-1">
                            {{ $siteSettings['contact_place_name'] ?? 'Jl. Jend. Sudirman Lingk. Cibeureum No.269, RT.01/RW.09, Sindangrasa, Kec. Ciamis, Kabupaten Ciamis, Jawa Barat 46215' }}
                        </p>
                    </div>
                    <div class="lg:w-1/2 px-6 mt-4 lg:mt-0">
                        <h2 class="title-font font-semibold text-gray-900 tracking-widest text-xs">EMAIL</h2>
                        <a
                            class="text-red-500 leading-relaxed">{{ $siteSettings['contact_email'] ?? 'surat@smkn1cms.net' }}</a>
                        <h2 class="title-font font-semibold text-gray-900 tracking-widest text-xs mt-4">TELEPON</h2>
                        <p class="leading-relaxed">{{ $siteSettings['contact_phone'] ?? '+62 822-1584-6592' }}</p>
                    </div>
                </div>
            </div>
            <form method="POST" action="{{ route('feedback.store') }}"
                class="lg:w-1/3 md:w-1/2 bg-white flex flex-col md:ml-auto w-full md:py-8 mt-8 md:mt-0">
                @csrf
                <h2 class="text-gray-900 text-lg mb-1 font-medium title-font">Saran dan Masukan</h2>
                <p class="leading-relaxed mb-5 text-gray-600">Silakan tinggalkan kritik dan saran Anda untuk kemajuan
                    layanan kami.</p>
                <div class="relative mb-4">
                    <label for="nama" class="leading-7 text-sm text-gray-600">Nama (opsional)</label>
                    <input type="text" id="nama" name="name"
                        class="w-full bg-white rounded border border-gray-300 focus:border-red-500 focus:ring-2 focus:ring-red-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                </div>
                <div class="relative mb-4">
                    <label for="kritik" class="leading-7 text-sm text-gray-600">Kritik</label>
                    <textarea id="kritik" name="kritik" placeholder="Tulis kritik dengan bahasa yang baik dan sopan"
                        class="w-full bg-white rounded border border-gray-300 focus:border-red-500 focus:ring-2 focus:ring-red-200 h-24 text-base outline-none text-gray-700 py-1 px-3 resize-none leading-6 transition-colors duration-200 ease-in-out"></textarea>
                </div>
                <div class="relative mb-4">
                    <label for="saran" class="leading-7 text-sm text-gray-600">Saran</label>
                    <textarea id="saran" name="saran"
                        class="w-full bg-white rounded border border-gray-300 focus:border-red-500 focus:ring-2 focus:ring-red-200 h-24 text-base outline-none text-gray-700 py-1 px-3 resize-none leading-6 transition-colors duration-200 ease-in-out"></textarea>
                </div>
                <button
                    class="text-white bg-hijau-light border-0 py-2 px-6 focus:outline-none hover:bg-hijau-dark rounded text-lg">Kirim</button>
                <p class="text-xs text-gray-500 mt-3">Masukan Anda sangat berarti bagi peningkatan pelayanan
                    perpustakaan kami.</p>
            </form>
        </div>
    </section>
    @include('layouts/partials/footer')

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const slider = document.getElementById('profileCards');
            const dotsContainer = document.getElementById('sliderDots');
            const prevSlideBtn = document.getElementById('prevSlideBtn');
            const nextSlideBtn = document.getElementById('nextSlideBtn');
            const faqItems = document.querySelectorAll('.faq-item');
            const items = document.querySelectorAll('.slider-item');
            const itemCount = items.length;
            const activeDotColor = '#031C62';
            const inactiveDotColor = '#CBD5E1';

            let visibleItems = 1;
            let currentIndex = 0;
            let stepCount = 0;

            function updateVisibleItems() {
                if (itemCount === 0) {
                    dotsContainer.innerHTML = "";
                    prevSlideBtn.classList.add('hidden');
                    nextSlideBtn.classList.add('hidden');
                    return;
                }

                if (window.innerWidth >= 1024) {
                    visibleItems = 3;
                } else if (window.innerWidth >= 768) {
                    visibleItems = 2;
                } else {
                    visibleItems = 1;
                }

                // Hitung jumlah pagination (pergeseran 1 item)
                stepCount = itemCount - visibleItems + 1;
                if (stepCount < 1) stepCount = 1;

                createDots();
                updateSliderPosition();
                updateArrowButtons();
            }

            function createDots() {
                dotsContainer.innerHTML = "";
                for (let i = 0; i < stepCount; i++) {
                    const dot = document.createElement('button');
                    dot.type = 'button';
                    dot.className = 'w-4 h-4 rounded-full transition-all duration-300';
                    dot.style.backgroundColor = i === 0 ? activeDotColor : inactiveDotColor;
                    dot.addEventListener('click', () => {
                        goToSlide(i);
                    });
                    dotsContainer.appendChild(dot);
                }
            }

            function goToSlide(index) {
                currentIndex = index;
                updateSliderPosition();
            }

            function goToNextSlide() {
                currentIndex = (currentIndex + 1) % stepCount;
                updateSliderPosition();
            }

            function goToPrevSlide() {
                currentIndex = (currentIndex - 1 + stepCount) % stepCount;
                updateSliderPosition();
            }

            function updateArrowButtons() {
                const shouldShow = stepCount > 1;
                prevSlideBtn.classList.toggle('hidden', !shouldShow);
                nextSlideBtn.classList.toggle('hidden', !shouldShow);
            }

            function updateSliderPosition() {
                const item = items[0];
                const itemWidth = item.offsetWidth + parseFloat(getComputedStyle(item).marginRight) + parseFloat(
                    getComputedStyle(item).marginLeft);
                const shift = itemWidth * currentIndex;

                slider.style.transform = `translateX(-${shift}px)`;
                slider.style.transition = 'transform 0.5s ease-in-out';

                const dots = dotsContainer.children;
                for (let i = 0; i < dots.length; i++) {
                    dots[i].style.backgroundColor = i === currentIndex ? activeDotColor : inactiveDotColor;
                    dots[i].style.transform = i === currentIndex ? 'scale(1.05)' : 'scale(1)';
                }
            }

            prevSlideBtn.addEventListener('click', goToPrevSlide);
            nextSlideBtn.addEventListener('click', goToNextSlide);

            faqItems.forEach((item) => {
                item.addEventListener('toggle', function() {
                    if (this.open) {
                        faqItems.forEach((other) => {
                            if (other !== this && other.open) {
                                other.open = false;
                            }
                        });
                    }
                });
            });

            window.addEventListener('resize', updateVisibleItems);
            updateVisibleItems();
            updateArrowButtons();
        });
    </script>
</body>

</html>
