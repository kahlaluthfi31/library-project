<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>{{ $layanan['judul'] }} | AmartaLib</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body class="bg-white text-gray-900 transition-colors duration-300">
    @include('layouts/partials/navbar')

    <main class="pt-24 pb-16 px-4 sm:px-6">
        <section class="max-w-screen-xl mx-auto">
            <div class="mb-8">
                <a href="{{ route('landing-page') }}#layanan" class="inline-flex items-center text-sm text-hijau-light hover:text-hijau-dark transition-colors">
                    <i class="fas fa-arrow-left mr-2"></i> Kembali ke Layanan
                </a>
                <h1 class="mt-4 text-3xl sm:text-4xl font-bold text-hijau-light">{{ $layanan['judul'] }}</h1>
                <p class="mt-3 text-hijau-dark text-lg">{{ $layanan['ringkasan'] }}</p>
            </div>

            <div class="rounded-2xl border border-gray-100 bg-white shadow-md overflow-hidden">
                <div class="relative">
                    <div id="galleryTrack" class="flex transition-transform duration-500 ease-in-out">
                        @foreach ($layanan['galeri'] as $index => $gambar)
                            <div class="w-full flex-shrink-0">
                                <img src="{{ $gambar }}" alt="Galeri {{ $layanan['judul'] }} {{ $index + 1 }}" class="w-full h-[240px] sm:h-[340px] lg:h-[420px] object-cover">
                            </div>
                        @endforeach
                    </div>

                    <button id="galleryPrev" type="button" aria-label="Sebelumnya"
                        class="absolute left-3 top-1/2 -translate-y-1/2 w-10 h-10 rounded-full bg-white/90 hover:bg-white text-hijau-light shadow-md transition flex items-center justify-center">
                        <i class="fas fa-chevron-left"></i>
                    </button>
                    <button id="galleryNext" type="button" aria-label="Berikutnya"
                        class="absolute right-3 top-1/2 -translate-y-1/2 w-10 h-10 rounded-full bg-white/90 hover:bg-white text-hijau-light shadow-md transition flex items-center justify-center">
                        <i class="fas fa-chevron-right"></i>
                    </button>
                </div>

                <div id="galleryDots" class="flex justify-center gap-2 py-4 bg-gray-50"></div>
            </div>

            <div class="mt-10 grid grid-cols-1 lg:grid-cols-3 gap-6">
                <div class="lg:col-span-3 rounded-xl border border-gray-100 p-6 bg-white shadow-sm">
                    <h2 class="text-2xl font-bold text-hijau-light mb-3">Detail Layanan</h2>
                    <p class="text-gray-700 leading-relaxed">{{ $layanan['deskripsi'] }}</p>
                </div>

                <div class="rounded-xl border border-gray-100 p-6 bg-white shadow-sm">
                    <h3 class="text-xl font-semibold text-hijau-light mb-3">Catatan</h3>
                    <ul class="space-y-2 text-gray-700 text-sm leading-relaxed">
                        @foreach ($layanan['catatan'] as $item)
                            <li class="flex items-start">
                                <i class="fas fa-circle text-[8px] mt-2 mr-3 text-hijau-light"></i>
                                <span>{{ $item }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <div class="lg:col-span-2 rounded-xl border border-gray-100 p-6 bg-white shadow-sm">
                    <h3 class="text-xl font-semibold text-hijau-light mb-3">Peraturan</h3>
                    <ul class="space-y-2 text-gray-700 text-sm leading-relaxed">
                        @foreach ($layanan['peraturan'] as $item)
                            <li class="flex items-start">
                                <i class="fas fa-check text-xs mt-1.5 mr-3 text-hijau-light"></i>
                                <span>{{ $item }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </section>
    </main>

    @include('layouts/partials/footer')

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const track = document.getElementById('galleryTrack');
            const slides = track ? Array.from(track.children) : [];
            const prevBtn = document.getElementById('galleryPrev');
            const nextBtn = document.getElementById('galleryNext');
            const dotsWrap = document.getElementById('galleryDots');

            if (!track || !slides.length || !prevBtn || !nextBtn || !dotsWrap) return;

            let current = 0;

            function renderDots() {
                dotsWrap.innerHTML = '';
                slides.forEach((_, index) => {
                    const dot = document.createElement('button');
                    dot.type = 'button';
                    dot.className = 'w-3 h-3 rounded-full transition-all duration-300';
                    dot.style.backgroundColor = index === current ? '#031C62' : '#CBD5E1';
                    dot.addEventListener('click', () => goTo(index));
                    dotsWrap.appendChild(dot);
                });
            }

            function goTo(index) {
                current = index;
                track.style.transform = `translateX(-${current * 100}%)`;
                renderDots();
            }

            prevBtn.addEventListener('click', () => {
                current = (current - 1 + slides.length) % slides.length;
                goTo(current);
            });

            nextBtn.addEventListener('click', () => {
                current = (current + 1) % slides.length;
                goTo(current);
            });

            goTo(0);
        });
    </script>
</body>

</html>
