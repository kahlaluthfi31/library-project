<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>Profil Perpustakaan Amarta</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* Custom Styles */
        .hero-gradient {
            background: linear-gradient(135deg, #2e7d32 0%, #1b5e20 100%);
        }

        .card-hover {
            transition: all 0.3s ease;
        }

        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        .section-animate {
            animation: fadeInUp 0.6s ease-out;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>

<body class="font-sans bg-gray-50">
    @php
        $profileContent = $profileContent ?? [];
        $profileSettings = $profileSettings ?? [];
        $ps = fn(string $key, string $default = '') => $profileSettings[$key] ?? $default;
    @endphp
    <!-- Navigation -->
    @include('layouts/partials/navbar')
    <!-- Hero Section -->
    <div class="relative bg-white min-h-[70vh] md:h-screen text-white overflow-hidden mt-[67px]">
        <div class="absolute inset-0">
            <!-- Gambar background -->
            <img src="https://plus.unsplash.com/premium_photo-1661905921900-a8b49e65feeb?q=80&w=2075&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                alt="Background Image"
                class="object-cover object-center w-full h-full" />

            <!-- Overlay gelap supaya teks terlihat -->
            <div class="absolute inset-0 bg-black bg-opacity-40"></div>

            <!-- Gradien ke bawah -->
            <div class="absolute inset-0 bg-gradient-to-b from-transparent via-white/5 to-white"></div>
        </div>

        <!-- Konten teks -->
    <div class="relative z-10 flex flex-col justify-center items-center min-h-[70vh] md:h-full text-center px-4 pt-16 sm:pt-20 md:pt-0">
            <h1 class="text-4xl md:text-5xl text-white font-bold leading-tight mb-4">Profil Perpustakaan</h1>
            <p class="text-lg text-white mb-8 max-w-2xl">Jelajahi kami lebih jauh - Amarta K-One Ciamis</p>
            <a href="#tentang" class="px-6 py-3 rounded-lg font-medium shadow-lg bg-hijau-light hover:bg-hijau-light text-white transition duration-300 transform hover:-translate-y-1">
                Mulai Jelajahi <i class="fas fa-arrow-down ml-2"></i></a>
        </div>

        <!-- Section scroll tujuan -->
        <div id="tentang" class="w-28 mb-20 bg-white"></div>
    </div>

    <!-- Main Content -->
    <main id="tentang" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <!-- About Section -->
        @if (!empty($profileContent['tentang']))
            {!! $profileContent['tentang'] !!}
        @else
        <section class="mb-20 section-animate">
            <div class="breadcrumbs text-sm mb-7">
                <ul class="text-black">
                    <li><a href="/">Beranda</a></li>
                    <li><a href="/profil-perpustakaan">Profil</a></li>
                </ul>
            </div>
            <div class="grid md:grid-cols-2 gap-12 items-center">
                <div>
                    <h2 class="text-3xl font-bold text-left text-gray-900 mb-6 relative">
                        <span class="relative z-10 bg-clip-text text-transparent bg-gradient-to-r from-hijau-light to-biru-light">
                            {{ $ps('profile_tentang_title', 'Tentang Perpustakaan Amarta') }}
                        </span>
                        <hr class="mt-3 border-gray-400 rounded-full">
                    </h2>
                    <div class="prose prose-lg text-gray-600">
                        <p>{{ $ps('profile_tentang_paragraph_1', 'Perpustakaan Digital Amarta merupakan pusat sumber belajar modern yang menyediakan akses terhadap berbagai koleksi buku digital, jurnal, dan materi pembelajaran lainnya.') }}</p>
                        <p class="mt-4">{{ $ps('profile_tentang_paragraph_2', 'Didirikan pada tahun 2010, kami telah berkembang menjadi salah satu perpustakaan digital terkemuka dengan lebih dari 50.000 judul koleksi dan 10.000 anggota aktif.') }}</p>
                        <p class="mt-4">{{ $ps('profile_tentang_paragraph_3', 'Kami berkomitmen untuk menyediakan layanan yang mudah diakses, koleksi yang berkualitas, dan lingkungan belajar yang nyaman bagi seluruh pengguna.') }}</p>
                    </div>
                </div>
                <div class="rounded-xl overflow-hidden shadow-xl">
                    <img src="{{ $ps('profile_tentang_image_url', 'https://images.unsplash.com/photo-1589998059171-988d887df646?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1000&q=80') }}"
                        alt="Perpustakaan Amarta"
                        class="w-full h-auto object-cover">
                </div>
            </div>
        </section>
        @endif

        <!-- Visi & Misi Section -->
        @if (!empty($profileContent['visi_misi']))
            {!! $profileContent['visi_misi'] !!}
        @else
        @php
            $decodePoints = function ($jsonValue) {
                if (! is_string($jsonValue) || trim($jsonValue) === '') {
                    return [];
                }

                $decoded = json_decode($jsonValue, true);

                if (! is_array($decoded)) {
                    return [];
                }

                return array_values(array_filter(array_map(static fn($item) => trim((string) $item), $decoded), static fn($item) => $item !== ''));
            };

            $visiIcon = trim($ps('profile_visi_icon', 'fa-eye'));
            $misiIcon = trim($ps('profile_misi_icon', 'fa-bullseye'));

            $visiUsePoints = $ps('profile_visi_use_points', '0') === '1';
            $misiUsePoints = $ps('profile_misi_use_points', '1') === '1';

            $visiPoints = $decodePoints($ps('profile_visi_points_json', ''));
            $misiPoints = $decodePoints($ps('profile_misi_points_json', ''));

            if (count($visiPoints) === 0) {
                $legacyVisiPoints = [];
                for ($i = 1; $i <= 4; $i++) {
                    $point = trim($ps('profile_visi_point_' . $i, ''));
                    if ($point !== '') {
                        $legacyVisiPoints[] = $point;
                    }
                }
                $visiPoints = $legacyVisiPoints;
            }

            if (count($misiPoints) === 0) {
                $legacyMisiPoints = [];
                for ($i = 1; $i <= 4; $i++) {
                    $point = trim($ps('profile_misi_point_' . $i, $ps('profile_misi_item_' . $i, '')));
                    if ($point !== '') {
                        $legacyMisiPoints[] = $point;
                    }
                }
                $misiPoints = $legacyMisiPoints;
            }
        @endphp
    <section id="visi" class="mb-4 py-14 sm:py-20 bg-gradient-to-r from-blue-50 to-blue-50 rounded-3xl px-4 sm:px-6 lg:px-8 section-animate">
            <div class="max-w-6xl mx-auto">
                <div class="text-center mb-16">
                    <h2 class="text-3xl md:text-4xl font-bold leading-tight bg-gradient-to-r from-hijau-light to-biru-light mb-4 bg-clip-text text-transparent">
                        Visi & Misi Perpustakaan
                    </h2>
                </div>
                <div class="grid lg:grid-cols-2 gap-8">
                    <!-- Visi Card -->
                    <div class="relative group">
                        <div class="relative h-full bg-white p-5 sm:p-8 rounded-2xl shadow-sm card-hover overflow-hidden border border-gray-100">
                            <div class="absolute -right-10 -top-10 text-blue-50 text-7xl z-0">
                                <i class="fas {{ $visiIcon ?: 'fa-eye' }}"></i>
                            </div>
                            <div class="relative z-10">
                                <div class="w-16 h-16 bg-blue-50 rounded-full flex items-center justify-center mb-6">
                                    <i class="fas {{ $visiIcon ?: 'fa-eye' }} text-blue-500 text-2xl"></i>
                                </div>
                                <h3 class="text-2xl font-bold mb-4 text-gray-800">{{ $ps('profile_visi_title', 'Visi Kami') }}</h3>
                                @if ($visiUsePoints)
                                    <ul class="space-y-3 text-md text-gray-600">
                                        @foreach ($visiPoints as $visiPoint)
                                            <li class="flex items-start gap-2">
                                                <span class="mt-1 text-blue-500"><i class="fas fa-check-circle"></i></span>
                                                <span>{{ $visiPoint }}</span>
                                            </li>
                                        @endforeach
                                    </ul>
                                @else
                                    <p class="text-md text-gray-600 leading-relaxed">
                                        {{ $ps('profile_visi_description', '"Menjadi pusat sumber belajar digital terdepan yang mendukung terciptanya masyarakat pembelajar sepanjang hayat."') }}
                                    </p>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Misi Card -->
                    <div class="relative group">
                        <div class="relative h-full bg-white p-5 sm:p-8 rounded-2xl shadow-sm card-hover overflow-hidden border border-gray-100">
                            <div class="absolute -right-10 -top-10 text-blue-50 text-7xl z-0">
                                <i class="fas {{ $misiIcon ?: 'fa-bullseye' }}"></i>
                            </div>
                            <div class="relative z-10">
                                <div class="w-16 h-16 bg-blue-50 rounded-full flex items-center justify-center mb-6">
                                    <i class="fas {{ $misiIcon ?: 'fa-bullseye' }} text-blue-500 text-2xl"></i>
                                </div>
                                <h3 class="text-2xl font-bold mb-4 text-gray-800">{{ $ps('profile_misi_title', 'Misi Kami') }}</h3>
                                @if ($misiUsePoints)
                                    <ul class="space-y-4">
                                        @foreach ($misiPoints as $misiPoint)
                                            <li class="flex items-start">
                                                <div class="flex-shrink-0 mt-1">
                                                    <div class="w-6 h-6 rounded-full bg-blue-50 flex items-center justify-center">
                                                        <i class="fas fa-check text-blue-400 text-xs"></i>
                                                    </div>
                                                </div>
                                                <p class="ml-3 text-gray-600">{{ $misiPoint }}</p>
                                            </li>
                                        @endforeach
                                    </ul>
                                @else
                                    <p class="text-md text-gray-600 leading-relaxed">
                                        {{ $ps('profile_misi_description', 'Misi perpustakaan berfokus pada peningkatan layanan, kualitas koleksi, literasi informasi, dan lingkungan belajar yang inklusif.') }}
                                    </p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="struktur" class="w-28 bg-white"></div>
        </section>
        @endif

        <!-- Struktur Organisasi -->
        @if (!empty($profileContent['struktur']))
            {!! $profileContent['struktur'] !!}
        @else
    <section class="pb-16 px-4 sm:px-6 bg-gradient-to-br from-blue-50 via-white to-blue-50">
            <div class="max-w-7xl mx-auto">
                <!-- Section Header -->
                <div class="text-center mb-16">
                    <span class="inline-block px-4 py-1 mb-4 text-sm font-medium rounded-full bg-gradient-to-r from-blue-100 to-blue-100 text-hijau-dark">
                        {{ $ps('profile_struktur_badge', 'Tim Kami') }}
                    </span>
                    <h2 class="text-3xl md:text-4xl font-bold leading-tight bg-gradient-to-r from-hijau-light to-biru-light mb-4 bg-clip-text text-transparent">
                        {{ $ps('profile_struktur_title', 'Tim Manajemen') }}
                    </h2>
                    <p class="text-md text-gray-600 max-w-3xl mx-auto">
                        {{ $ps('profile_struktur_description', 'Tim profesional yang berdedikasi untuk memberikan pelayanan terbaik bagi pengunjung perpustakaan') }}
                    </p>
                </div>

                <!-- Organizational Chart -->
                <div class="relative">
                    <!-- Connector Lines -->
                    <div class="absolute inset-0 flex justify-center items-center pointer-events-none">
                        <div class="h-full w-px bg-gradient-to-b from-transparent via-gray-300 to-transparent"></div>
                    </div>

                    <!-- Level 1 - Top Management -->
                    <div class="flex justify-center mb-16 relative z-10">
                        <div class="group">
                            <div class="relative w-44 sm:w-48 h-56 sm:h-60 mx-auto rounded-2xl overflow-hidden shadow-xl transition-all duration-500 transform group-hover:-translate-y-3 group-hover:shadow-2xl">
                                <img src="{{ $ps('profile_struktur_ketua_image', 'https://media.istockphoto.com/id/1348560814/id/foto/wanita-bisnis-percaya-diri-dalam-kacamata-melihat-kamera.jpg?s=1024x1024&w=is&k=20&c=-oCccOZT4hvJIvZwela7_pkJ-ntxll9z2PmDlAPq1Wo=') }}"
                                    alt="Ketua"
                                    class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                                <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent"></div>
                                <div class="absolute bottom-0 left-0 right-0 p-4 text-center">
                                    <h3 class="text-white font-bold text-lg">{{ $ps('profile_struktur_ketua_name', 'Kahla Luthfiyah') }}</h3>
                                    <p class="text-blue-200 text-sm">{{ $ps('profile_struktur_ketua_position', 'Ketua Umum') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Level 2 - Middle Management -->
                    <div class="flex justify-center gap-8 sm:gap-12 mb-16 relative z-10 flex-wrap">
                        <!-- Wakil Ketua -->
                        <div class="group">
                            <div class="relative w-44 sm:w-48 h-56 sm:h-60 mx-auto rounded-xl overflow-hidden shadow-lg transition-all duration-500 transform group-hover:-translate-y-3 group-hover:shadow-xl">
                                <img src="{{ $ps('profile_struktur_wakil_image', 'https://media.istockphoto.com/id/1348560814/id/foto/wanita-bisnis-percaya-diri-dalam-kacamata-melihat-kamera.jpg?s=1024x1024&w=is&k=20&c=-oCccOZT4hvJIvZwela7_pkJ-ntxll9z2PmDlAPq1Wo=') }}"
                                    alt="Wakil Ketua"
                                    class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                                <div class="absolute inset-0 bg-gradient-to-t from-black/40 to-transparent"></div>
                                <div class="absolute bottom-0 left-0 right-0 p-3 text-center">
                                    <h4 class="text-white font-semibold">{{ $ps('profile_struktur_wakil_name', 'Novia R.') }}</h4>
                                    <p class="text-blue-100 text-xs">{{ $ps('profile_struktur_wakil_position', 'Wakil Ketua') }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Sekretaris -->
                        <div class="group">
                            <div class="relative w-44 sm:w-48 h-56 sm:h-60 mx-auto rounded-xl overflow-hidden shadow-lg transition-all duration-500 transform group-hover:-translate-y-3 group-hover:shadow-xl">
                                <img src="{{ $ps('profile_struktur_sekretaris_image', 'https://media.istockphoto.com/id/1348560814/id/foto/wanita-bisnis-percaya-diri-dalam-kacamata-melihat-kamera.jpg?s=1024x1024&w=is&k=20&c=-oCccOZT4hvJIvZwela7_pkJ-ntxll9z2PmDlAPq1Wo=') }}"
                                    alt="Sekretaris"
                                    class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                                <div class="absolute inset-0 bg-gradient-to-t from-black/40 to-transparent"></div>
                                <div class="absolute bottom-0 left-0 right-0 p-3 text-center">
                                    <h4 class="text-white font-semibold">{{ $ps('profile_struktur_sekretaris_name', 'Kaylla M.') }}</h4>
                                    <p class="text-blue-100 text-xs">{{ $ps('profile_struktur_sekretaris_position', 'Sekretaris') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Level 3 - Staff -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 relative z-10 max-w-4xl mx-auto">
                        <!-- Bendahara -->
                        <div class="group">
                            <div class="relative w-44 sm:w-48 h-56 sm:h-60 mx-auto rounded-lg overflow-hidden shadow-md transition-all duration-500 transform group-hover:-translate-y-2 group-hover:shadow-lg">
                                <img src="{{ $ps('profile_struktur_staff_1_image', 'https://media.istockphoto.com/id/1348560814/id/foto/wanita-bisnis-percaya-diri-dalam-kacamata-melihat-kamera.jpg?s=1024x1024&w=is&k=20&c=-oCccOZT4hvJIvZwela7_pkJ-ntxll9z2PmDlAPq1Wo=') }}"
                                    alt="Bendahara"
                                    class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                                <div class="absolute inset-0 bg-gradient-to-t from-black/30 to-transparent"></div>
                                <div class="absolute bottom-0 left-0 right-0 p-2 text-center">
                                    <h5 class="text-white font-semibold text-sm">{{ $ps('profile_struktur_staff_1_name', 'Sifa L.') }}</h5>
                                    <p class="text-blue-50 text-xs">{{ $ps('profile_struktur_staff_1_position', 'Bendahara') }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Humas -->
                        <div class="group">
                            <div class="relative w-44 sm:w-48 h-56 sm:h-60 mx-auto rounded-lg overflow-hidden shadow-md transition-all duration-500 transform group-hover:-translate-y-2 group-hover:shadow-lg">
                                <img src="{{ $ps('profile_struktur_staff_2_image', 'https://media.istockphoto.com/id/1348560814/id/foto/wanita-bisnis-percaya-diri-dalam-kacamata-melihat-kamera.jpg?s=1024x1024&w=is&k=20&c=-oCccOZT4hvJIvZwela7_pkJ-ntxll9z2PmDlAPq1Wo=') }}"
                                    alt="Humas"
                                    class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                                <div class="absolute inset-0 bg-gradient-to-t from-black/30 to-transparent"></div>
                                <div class="absolute bottom-0 left-0 right-0 p-2 text-center">
                                    <h5 class="text-white font-semibold text-sm">{{ $ps('profile_struktur_staff_2_name', 'Dhani F.') }}</h5>
                                    <p class="text-blue-50 text-xs">{{ $ps('profile_struktur_staff_2_position', 'Humas') }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Koordinator Divisi -->
                        <div class="group">
                            <div class="relative w-44 sm:w-48 h-56 sm:h-60 mx-auto rounded-lg overflow-hidden shadow-md transition-all duration-500 transform group-hover:-translate-y-2 group-hover:shadow-lg">
                                <img src="{{ $ps('profile_struktur_staff_3_image', 'https://media.istockphoto.com/id/1348560814/id/foto/wanita-bisnis-percaya-diri-dalam-kacamata-melihat-kamera.jpg?s=1024x1024&w=is&k=20&c=-oCccOZT4hvJIvZwela7_pkJ-ntxll9z2PmDlAPq1Wo=') }}"
                                    alt="Koordinator"
                                    class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                                <div class="absolute inset-0 bg-gradient-to-t from-black/30 to-transparent"></div>
                                <div class="absolute bottom-0 left-0 right-0 p-2 text-center">
                                    <h5 class="text-white font-semibold text-sm">{{ $ps('profile_struktur_staff_3_name', 'Zahra A.') }}</h5>
                                    <p class="text-blue-50 text-xs">{{ $ps('profile_struktur_staff_3_position', 'Koordinator Divisi') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        @endif

        <!-- Staff & Pustakawan -->
        @if (!empty($profileContent['staff']))
            {!! $profileContent['staff'] !!}
        @else
        <section id="staff" class="py-16 bg-gradient-to-br from-white to-gray-50">
            <div class="max-w-6xl mx-auto px-4 sm:px-6">
                <!-- Section Header -->
                <div class="text-center mb-12">
                    <span class="inline-block px-3 py-1 mb-3 text-xs font-medium rounded-full bg-blue-100 text-hijau-dark shadow-sm">
                        {{ $ps('profile_staff_badge', 'Tim Profesional Kami') }}
                    </span>
                    <h2 class="text-3xl md:text-4xl font-bold bg-gradient-to-r from-hijau-light to-biru-light mb-3 bg-clip-text text-transparent">
                        {{ $ps('profile_staff_title', 'Staff & Pustakawan') }}
                    </h2>
                    <p class="text-sm md:text-base text-gray-600 max-w-2xl mx-auto">
                        {{ $ps('profile_staff_description', 'Tim ahli yang berdedikasi untuk memberikan pengalaman terbaik bagi pengunjung perpustakaan') }}
                    </p>
                </div>

                <!-- Staff Grid -->
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4">
                    <!-- Staff 1 -->
                    <div class="group relative overflow-hidden rounded-lg shadow-md transition-all duration-300 hover:shadow-lg hover:-translate-y-1 max-w-[220px] w-full mx-auto">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/30 to-transparent z-10"></div>
                        <img src="{{ $ps('profile_staff_1_image', 'https://images.unsplash.com/photo-1560250097-0b93528c311a?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=600&q=80') }}"
                            alt="Staff 1"
                            class="w-full h-72 sm:h-80 object-cover transition-transform duration-500 group-hover:scale-105">

                        <div class="absolute bottom-0 left-0 right-0 z-20 p-3 text-white">
                            <h3 class="text-base font-bold mb-1 leading-tight">{{ $ps('profile_staff_1_name', 'Dr. John Doe') }}</h3>
                            <p class="text-blue-300 text-xs font-medium mb-1">{{ $ps('profile_staff_1_position', 'Kepala Perpustakaan') }}</p>
                            <p class="text-gray-200 text-xs leading-relaxed md:max-h-0 md:opacity-0 md:overflow-hidden md:group-hover:max-h-20 md:group-hover:opacity-100 md:transition-all md:duration-300">
                                {{ $ps('profile_staff_1_description', 'Memimpin seluruh operasional perpustakaan sejak 2015.') }}
                            </p>
                        </div>
                    </div>

                    <!-- Staff 2 -->
                    <div class="group relative overflow-hidden rounded-lg shadow-md transition-all duration-300 hover:shadow-lg hover:-translate-y-1 max-w-[220px] w-full mx-auto">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/30 to-transparent z-10"></div>
                        <img src="{{ $ps('profile_staff_2_image', 'https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=600&q=80') }}"
                            alt="Staff 2"
                            class="w-full h-72 sm:h-80 object-cover transition-transform duration-500 group-hover:scale-105">

                        <div class="absolute bottom-0 left-0 right-0 z-20 p-3 text-white">
                            <h3 class="text-base font-bold mb-1 leading-tight">{{ $ps('profile_staff_2_name', 'Jane Smith') }}</h3>
                            <p class="text-blue-300 text-xs font-medium mb-1">{{ $ps('profile_staff_2_position', 'Pustakawan') }}</p>
                            <p class="text-gray-200 text-xs leading-relaxed md:max-h-0 md:opacity-0 md:overflow-hidden md:group-hover:max-h-20 md:group-hover:opacity-100 md:transition-all md:duration-300">
                                {{ $ps('profile_staff_2_description', 'Bertanggung jawab atas pengembangan koleksi.') }}
                            </p>
                        </div>
                    </div>

                    <!-- Staff 3 -->
                    <div class="group relative overflow-hidden rounded-lg shadow-md transition-all duration-300 hover:shadow-lg hover:-translate-y-1 max-w-[220px] w-full mx-auto">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/30 to-transparent z-10"></div>
                        <img src="{{ $ps('profile_staff_3_image', 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=600&q=80') }}"
                            alt="Staff 3"
                            class="w-full h-72 sm:h-80 object-cover transition-transform duration-500 group-hover:scale-105">

                        <div class="absolute bottom-0 left-0 right-0 z-20 p-3 text-white">
                            <h3 class="text-base font-bold mb-1 leading-tight">{{ $ps('profile_staff_3_name', 'Robert Johnson') }}</h3>
                            <p class="text-blue-300 text-xs font-medium mb-1">{{ $ps('profile_staff_3_position', 'Staff Layanan') }}</p>
                            <p class="text-gray-200 text-xs leading-relaxed md:max-h-0 md:opacity-0 md:overflow-hidden md:group-hover:max-h-20 md:group-hover:opacity-100 md:transition-all md:duration-300">
                                {{ $ps('profile_staff_3_description', 'Melayani peminjaman dan pengembalian buku.') }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        @endif

        <!-- Fasilitas -->
        @if (!empty($profileContent['fasilitas']))
            {!! $profileContent['fasilitas'] !!}
        @else
        <section id="fasilitas" class="py-16 sm:py-20 bg-gradient-to-br from-gray-50 to-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6">
                <!-- Section Header -->
                <div class="text-center mb-16">
                    <span class="inline-block px-4 py-2 mb-4 text-sm font-medium rounded-full bg-blue-100 text-hijau-dark shadow-sm">
                        {{ $ps('profile_fasilitas_badge', 'Fasilitas Unggulan') }}
                    </span>
                    <h2 class="text-4xl md:text-4xl font-bold bg-gradient-to-r from-hijau-light to-biru-light mb-4 bg-clip-text text-transparent">
                        {{ $ps('profile_fasilitas_title', 'Fasilitas Perpustakaan') }}
                    </h2>
                    <p class="text-md text-gray-600 max-w-3xl mx-auto">
                        {{ $ps('profile_fasilitas_description', 'Nikmati berbagai fasilitas modern yang dirancang untuk mendukung kebutuhan akademik Anda') }}
                    </p>
                </div>

                <!-- Facilities Grid -->
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <!-- Facility 1 -->
                    <div class="group relative bg-white rounded-2xl overflow-hidden shadow-lg transition-all duration-500 hover:shadow-xl hover:-translate-y-2">
                        <div class="absolute inset-0 bg-gradient-to-br from-blue-50 to-blue-50 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                        <div class="relative z-10 p-8 h-full flex flex-col">
                            <div class="w-16 h-16 mb-6 rounded-xl bg-gradient-to-r from-hijau-light to-biru-light flex items-center justify-center text-white text-2xl shadow-md">
                                <i class="{{ $ps('profile_fasilitas_1_icon', 'fas fa-book') }}"></i>
                            </div>
                            <h3 class="text-2xl font-bold mb-3 text-gray-800">{{ $ps('profile_fasilitas_1_title', 'Koleksi Lengkap') }}</h3>
                            <p class="text-gray-600 mb-6 flex-grow">{{ $ps('profile_fasilitas_1_description', '50.000+ buku digital dan fisik dari berbagai disiplin ilmu terkini.') }}</p>
                        </div>
                    </div>

                    <!-- Facility 2 -->
                    <div class="group relative bg-white rounded-2xl overflow-hidden shadow-lg transition-all duration-500 hover:shadow-xl hover:-translate-y-2">
                        <div class="absolute inset-0 bg-gradient-to-br from-blue-50 to-blue-50 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                        <div class="relative z-10 p-8 h-full flex flex-col">
                            <div class="w-16 h-16 mb-6 rounded-xl bg-gradient-to-r from-hijau-light to-biru-light flex items-center justify-center text-white text-2xl shadow-md">
                                <i class="{{ $ps('profile_fasilitas_2_icon', 'fas fa-wifi') }}"></i>
                            </div>
                            <h3 class="text-2xl font-bold mb-3 text-gray-800">{{ $ps('profile_fasilitas_2_title', 'Internet Gratis') }}</h3>
                            <p class="text-gray-600 mb-6 flex-grow">{{ $ps('profile_fasilitas_2_description', 'Akses WiFi berkecepatan tinggi di seluruh area perpustakaan.') }}</p>
                        </div>
                    </div>

                    <!-- Facility 3 -->
                    <div class="group relative bg-white rounded-2xl overflow-hidden shadow-lg transition-all duration-500 hover:shadow-xl hover:-translate-y-2">
                        <div class="absolute inset-0 bg-gradient-to-br from-blue-50 to-blue-50 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                        <div class="relative z-10 p-8 h-full flex flex-col">
                            <div class="w-16 h-16 mb-6 rounded-xl bg-gradient-to-r from-hijau-light to-biru-light flex items-center justify-center text-white text-2xl shadow-md">
                                <i class="{{ $ps('profile_fasilitas_3_icon', 'fas fa-laptop') }}"></i>
                            </div>
                            <h3 class="text-2xl font-bold mb-3 text-gray-800">{{ $ps('profile_fasilitas_3_title', 'Komputer Publik') }}</h3>
                            <p class="text-gray-600 mb-6 flex-grow">{{ $ps('profile_fasilitas_3_description', '20 unit komputer canggih dengan akses ke sumber digital.') }}</p>
                        </div>
                    </div>

                    <!-- Facility 4 -->
                    <div class="group relative bg-white rounded-2xl overflow-hidden shadow-lg transition-all duration-500 hover:shadow-xl hover:-translate-y-2">
                        <div class="absolute inset-0 bg-gradient-to-br from-blue-50 to-blue-50 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                        <div class="relative z-10 p-8 h-full flex flex-col">
                            <div class="w-16 h-16 mb-6 rounded-xl bg-gradient-to-r from-hijau-light to-biru-light flex items-center justify-center text-white text-2xl shadow-md">
                                <i class="{{ $ps('profile_fasilitas_4_icon', 'fas fa-couch') }}"></i>
                            </div>
                            <h3 class="text-2xl font-bold mb-3 text-gray-800">{{ $ps('profile_fasilitas_4_title', 'Ruang Baca Nyaman') }}</h3>
                            <p class="text-gray-600 mb-6 flex-grow">{{ $ps('profile_fasilitas_4_description', 'Area baca premium dengan fasilitas ergonomis dan pencahayaan optimal.') }}</p>
                        </div>
                    </div>

                    <!-- Facility 5 -->
                    <div class="group relative bg-white rounded-2xl overflow-hidden shadow-lg transition-all duration-500 hover:shadow-xl hover:-translate-y-2">
                        <div class="absolute inset-0 bg-gradient-to-br from-blue-50 to-blue-50 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                        <div class="relative z-10 p-8 h-full flex flex-col">
                            <div class="w-16 h-16 mb-6 rounded-xl bg-gradient-to-r from-hijau-light to-biru-light flex items-center justify-center text-white text-2xl shadow-md">
                                <i class="{{ $ps('profile_fasilitas_5_icon', 'fas fa-print') }}"></i>
                            </div>
                            <h3 class="text-2xl font-bold mb-3 text-gray-800">{{ $ps('profile_fasilitas_5_title', 'Layanan Cetak') }}</h3>
                            <p class="text-gray-600 mb-6 flex-grow">{{ $ps('profile_fasilitas_5_description', 'Fasilitas pencetakan dan fotokopi dokumen berkualitas tinggi.') }}</p>
                        </div>
                    </div>

                    <!-- Facility 6 -->
                    <div class="group relative bg-white rounded-2xl overflow-hidden shadow-lg transition-all duration-500 hover:shadow-xl hover:-translate-y-2">
                        <div class="absolute inset-0 bg-gradient-to-br from-blue-50 to-blue-50 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                        <div class="relative z-10 p-8 h-full flex flex-col">
                            <div class="w-16 h-16 mb-6 rounded-xl bg-gradient-to-r from-hijau-light to-biru-light flex items-center justify-center text-white text-2xl shadow-md">
                                <i class="{{ $ps('profile_fasilitas_6_icon', 'fas fa-users') }}"></i>
                            </div>
                            <h3 class="text-2xl font-bold mb-3 text-gray-800">{{ $ps('profile_fasilitas_6_title', 'Ruang Diskusi') }}</h3>
                            <p class="text-gray-600 mb-6 flex-grow">{{ $ps('profile_fasilitas_6_description', 'Area khusus untuk diskusi kelompok dengan teknologi pendukung.') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        @endif

        <!-- Peraturan & Tata Tertib -->
        @if (!empty($profileContent['peraturan']))
            {!! $profileContent['peraturan'] !!}
        @else
        <section id="peraturan" class="py-20 bg-gradient-to-br from-gray-50 to-white">
            <div class="max-w-7xl mx-auto px-6">
                <!-- Section Header -->
                <div class="text-center mb-16">
                    <span class="inline-block px-4 py-2 mb-4 text-sm font-medium rounded-full bg-blue-100 text-hijau-dark shadow-sm">
                        {{ $ps('profile_peraturan_badge', 'Ketentuan Penggunaan') }}
                    </span>
                    <h2 class="text-4xl md:text-4xl font-bold mb-4 bg-clip-text text-transparent bg-gradient-to-r from-hijau-light to-biru-light">
                        {{ $ps('profile_peraturan_title', 'Peraturan & Tata Tertib') }}
                    </h2>
                    <p class="text-md text-gray-600 max-w-3xl mx-auto">
                        {{ $ps('profile_peraturan_description', 'Untuk kenyamanan bersama, harap patuhi ketentuan yang berlaku di perpustakaan kami') }}
                    </p>
                </div>

                <!-- Rules Container -->
                <div class="max-w-4xl mx-auto">
                    <!-- Rule 1 -->
                    <div class="group relative bg-white rounded-2xl overflow-hidden shadow-lg mb-6 transition-all duration-300 hover:shadow-xl hover:-translate-y-1">
                        <div class="absolute inset-0 bg-gradient-to-br from-blue-50 to-blue-50 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        <div class="relative z-10 p-8">
                            <div class="flex items-start">
                                <div class="flex-shrink-0 bg-gradient-to-r from-hijau-light to-biru-light text-white rounded-xl w-12 h-12 flex items-center justify-center text-xl font-bold shadow-md mr-6">
                                    1
                                </div>
                                <div>
                                    <h3 class="text-2xl font-bold text-gray-800 mb-3">{{ $ps('profile_peraturan_rule_1_title', 'Jam Operasional') }}</h3>
                                    <div class="flex flex-col sm:flex-row gap-4 text-gray-600">
                                        <div class="bg-gray-50 p-4 rounded-lg flex-1">
                                            <p class="font-medium text-gray-700 mb-1">Senin-Jumat</p>
                                            <p>08.00-20.00 WIB</p>
                                        </div>
                                        <div class="bg-gray-50 p-4 rounded-lg flex-1">
                                            <p class="font-medium text-gray-700 mb-1">Sabtu-Minggu</p>
                                            <p>09.00-17.00 WIB</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Rule 2 -->
                    <div class="group relative bg-white rounded-2xl overflow-hidden shadow-lg mb-6 transition-all duration-300 hover:shadow-xl hover:-translate-y-1">
                        <div class="absolute inset-0 bg-gradient-to-br from-blue-50 to-blue-50 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        <div class="relative z-10 p-8">
                            <div class="flex items-start">
                                <div class="flex-shrink-0 bg-gradient-to-r from-hijau-light to-biru-light text-white rounded-xl w-12 h-12 flex items-center justify-center text-xl font-bold shadow-md mr-6">
                                    2
                                </div>
                                <div>
                                    <h3 class="text-2xl font-bold text-gray-800 mb-3">{{ $ps('profile_peraturan_rule_2_title', 'Peminjaman Buku') }}</h3>
                                    <div class="grid md:grid-cols-2 gap-4 text-gray-600">
                                        <div class="bg-gray-50 p-4 rounded-lg">
                                            <p class="font-medium text-gray-700 mb-1">Kuota Peminjaman</p>
                                            <p>Maksimal 5 buku per anggota</p>
                                        </div>
                                        <div class="bg-gray-50 p-4 rounded-lg">
                                            <p class="font-medium text-gray-700 mb-1">Durasi Peminjaman</p>
                                            <p>14 hari per buku</p>
                                        </div>
                                        <div class="bg-gray-50 p-4 rounded-lg">
                                            <p class="font-medium text-gray-700 mb-1">Denda Keterlambatan</p>
                                            <p>Rp2.000 per hari per buku</p>
                                        </div>
                                        <div class="bg-gray-50 p-4 rounded-lg">
                                            <p class="font-medium text-gray-700 mb-1">Perpanjangan</p>
                                            <p>Maksimal 1 kali per buku</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Rule 3 -->
                    <div class="group relative bg-white rounded-2xl overflow-hidden shadow-lg mb-6 transition-all duration-300 hover:shadow-xl hover:-translate-y-1">
                        <div class="absolute inset-0 bg-gradient-to-br from-blue-50 to-blue-50 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        <div class="relative z-10 p-8">
                            <div class="flex items-start">
                                <div class="flex-shrink-0 bg-gradient-to-r from-hijau-light to-biru-light text-white rounded-xl w-12 h-12 flex items-center justify-center text-xl font-bold shadow-md mr-6">
                                    3
                                </div>
                                <div>
                                    <h3 class="text-2xl font-bold text-gray-800 mb-3">{{ $ps('profile_peraturan_rule_3_title', 'Perilaku di Perpustakaan') }}</h3>
                                    <div class="grid md:grid-cols-2 gap-4 text-gray-600">
                                        <div class="bg-gray-50 p-4 rounded-lg flex items-start">
                                            <div class="text-hijau-dark mr-3 mt-0.5">
                                                <i class="fas fa-volume-mute"></i>
                                            </div>
                                            <div>
                                                <p class="font-medium text-gray-700">Menjaga Ketenangan</p>
                                                <p class="text-sm">Hindari suara berlebihan di area baca</p>
                                            </div>
                                        </div>
                                        <div class="bg-gray-50 p-4 rounded-lg flex items-start">
                                            <div class="text-hijau-dark mr-3 mt-0.5">
                                                <i class="fas fa-smoking-ban"></i>
                                            </div>
                                            <div>
                                                <p class="font-medium text-gray-700">Larangan Merokok</p>
                                                <p class="text-sm">Dilarang merokok di seluruh area</p>
                                            </div>
                                        </div>
                                        <div class="bg-gray-50 p-4 rounded-lg flex items-start">
                                            <div class="text-hijau-dark mr-3 mt-0.5">
                                                <i class="fas fa-utensils"></i>
                                            </div>
                                            <div>
                                                <p class="font-medium text-gray-700">Aturan Makan</p>
                                                <p class="text-sm">Hanya diperbolehkan di area kantin</p>
                                            </div>
                                        </div>
                                        <div class="bg-gray-50 p-4 rounded-lg flex items-start">
                                            <div class="text-hijau-dark mr-3 mt-0.5">
                                                <i class="fas fa-broom"></i>
                                            </div>
                                            <div>
                                                <p class="font-medium text-gray-700">Kebersihan</p>
                                                <p class="text-sm">Jaga kebersihan fasilitas yang digunakan</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Rule 4 -->
                    <div class="group relative bg-white rounded-2xl overflow-hidden shadow-lg transition-all duration-300 hover:shadow-xl hover:-translate-y-1">
                        <div class="absolute inset-0 bg-gradient-to-br from-blue-50 to-blue-50 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        <div class="relative z-10 p-8">
                            <div class="flex items-start">
                                <div class="flex-shrink-0 bg-gradient-to-r from-hijau-light to-biru-light text-white rounded-xl w-12 h-12 flex items-center justify-center text-xl font-bold shadow-md mr-6">
                                    4
                                </div>
                                <div>
                                    <h3 class="text-2xl font-bold text-gray-800 mb-3">{{ $ps('profile_peraturan_rule_4_title', 'Layanan Digital') }}</h3>
                                    <div class="grid md:grid-cols-2 gap-4 text-gray-600">
                                        <div class="bg-gray-50 p-4 rounded-lg">
                                            <p class="font-medium text-gray-700 mb-1">Akses 24 Jam</p>
                                            <p>Koleksi digital dapat diakses kapan saja</p>
                                        </div>
                                        <div class="bg-gray-50 p-4 rounded-lg">
                                            <p class="font-medium text-gray-700 mb-1">Login Anggota</p>
                                            <p>Gunakan kredensial yang telah diberikan</p>
                                        </div>
                                        <div class="bg-gray-50 p-4 rounded-lg">
                                            <p class="font-medium text-gray-700 mb-1">Kuota Unduh</p>
                                            <p>Maksimal 20 dokumen per bulan</p>
                                        </div>
                                        <div class="bg-gray-50 p-4 rounded-lg">
                                            <p class="font-medium text-gray-700 mb-1">Panduan</p>
                                            <p>Lihat tutorial penggunaan di website</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Download Button -->
                <div class="text-center mt-16">
                    <button class="px-8 py-3.5 bg-gradient-to-r from-hijau-light to-biru-light text-white rounded-full font-medium shadow-lg hover:shadow-xl transition-all duration-300 hover:from-hijau-dark hover:to-biru-dark transform hover:-translate-y-1 flex items-center mx-auto">
                        <i class="fas fa-file-pdf mr-2"></i>
                        Unduh Peraturan Lengkap
                    </button>
                </div>
            </div>
        </section>
        @endif
    </main>

    <!-- Footer -->
    @include('layouts/partials/footer')

    <!-- Back to Top Button -->
    <button id="backToTop" class="fixed w-10 h-10 sm:w-12 sm:h-12 bottom-20 sm:bottom-8 right-3 sm:right-8 bg-blue-600 text-white rounded-full shadow-lg opacity-0 invisible transition-all hover:bg-blue-700 z-50 flex items-center justify-center">
        <i class="fas fa-arrow-up"></i>
    </button>

    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <script>
        // Back to Top Button
        const backToTop = document.getElementById('backToTop');

        window.addEventListener('scroll', () => {
            if (window.pageYOffset > 300) {
                backToTop.classList.remove('opacity-0', 'invisible');
                backToTop.classList.add('opacity-100', 'visible');
            } else {
                backToTop.classList.remove('opacity-100', 'visible');
                backToTop.classList.add('opacity-0', 'invisible');
            }
        });

        backToTop.addEventListener('click', () => {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });

        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });
    </script>
</body>

</html>