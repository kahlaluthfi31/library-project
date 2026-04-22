<div class="w-full">
    <footer class="footer sm:footer-horizontal bg-hijau-dark transition-colors duration-300 text-white p-6 sm:p-12 w-full">
        <aside class="max-w-xs">
            <div class="flex items-center gap-2 mb-4">
                <img src="{{ asset('img/logoamarta.png') }}" alt="" class="rounded-full w-12">
                <h2 class="text-2xl font-semibold">{{ $siteSettings['footer_title'] ?? 'Amarta K-One Ciamis' }}</h2>
            </div>
            <p class="text-sm sm:text-base break-words whitespace-normal">
                {{ $siteSettings['footer_description'] ?? 'Kami hadir untuk mendukung kegiatan literasi warga sekolah dengan berbagai informasi, layanan, dan koleksi buku.' }}
                <br /><br />
                SMKN 1 CIAMIS.
            </p>
        </aside>
        
        <nav>
            <h6 class="footer-title">Navigasi</h6>
            <a class="link link-hover">Profil</a>
            <a class="link link-hover">Layanan</a>
            <a class="link link-hover">Survei Layanan</a>
            <a class="link link-hover">FAQ</a>
        </nav>
        
        <nav>
            <h6 class="footer-title">Tautan Lain</h6>
            <a class="link link-hover">Website Sekolah</a>
            <a class="link link-hover">Berita & Artikel</a>
            <a class="link link-hover">Saran & masukan</a>
            <a class="link link-hover">Digilib</a>
        </nav>
        
        <nav>
            <h6 class="footer-title">Legal</h6>
            <a class="link link-hover">Terms of use</a>
            <a class="link link-hover">Privacy policy</a>
            <a class="link link-hover">Cookie policy</a>
        </nav>
        
        <nav class="flex flex-col gap-2">
            <h6 class="footer-title">Informasi</h6>
            <div class="flex gap-3">
                <!-- Social Media Icons (same as before) -->
                <a><svg...></svg></a>
                <a><svg...></svg></a>
                <a><svg...></svg></a>
                <a><svg...></svg></a>
                <a><svg...></svg></a>
            </div>
            <a href="" class="link link-hover">+62 822-1584-6592</a>
            <a href="" class="link link-hover">surat@smkn1cms.net</a>
            <p class="text-sm break-words whitespace-normal max-w-[200px]">
                Jl. Jend. Sudirman Lingk. Cibeureum No.269, RT.01/RW.09, Sindangrasa, Kec. Ciamis, Kabupaten Ciamis, Jawa Barat 46215
            </p>
        </nav>
    </footer>
    
    <footer class="footer sm:footer-horizontal items-center bg-hijau-dark transition-colors duration-300 text-white p-6 sm:p-10 px-4 sm:px-12 md:px-24 lg:px-48 xl:px-64 bottom-0 w-full my-0 justify-center">
        <aside class="text-center">
            <p>© {{ date('Y') }} AmartaLib - All right reserved</p>
        </aside>
    </footer>
</div>
