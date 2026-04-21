<div class="navbar navbar-font w-full px-8 sm:px-12 shadow-sm bg-hijau-light text-white transition-colors duration-300 fixed top-0 left-0 right-0 z-50">
    <!-- Navbar Start (Logo & Hamburger) -->
    <div class="navbar-start">
        <!-- Hamburger Menu (Mobile) -->
        <div class="dropdown lg:hidden">
            <div tabindex="0" role="button" class="btn btn-ghost">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </div>
            <ul tabindex="0" class="menu menu-sm dropdown-content mt-3 z-[1] p-2 shadow bg-hijau-light dark:bg-hijau-dark rounded-box w-52 font-medium">
                <li><a href="{{ route('landing-page') }}">Beranda</a></li>
                <li>
                    <details>
                        <summary>Profil</summary>
                        <ul>
                            <li><a href="/profil-perpustakaan#">Tentang Perpustakaan</a></li>
                            <li><a href="/profil-perpustakaan#">Visi & Misi</a></li>
                            <li><a href="/profil-perpustakaan#">Struktur Organisasi</a></li>
                            <li><a href="/profil-perpustakaan#">Staff & Pustakawan</a></li>
                            <li><a href="/profil-perpustakaan#">Fasilitas</a></li>
                            <li><a href="/profil-perpustakaan#">Peraturan & Tata Tertib</a></li>
                        </ul>
                    </details>
                </li>
                <li><a href="https://e-lib.smkn1ciamis.id/">Digilib</a></li>
                <li><a href="{{ route('blog-perpustakaan') }}">Blog</a></li>
                <li><a href="/#kontak">Kontak</a></li>
            </ul>
        </div>

        <!-- Logo & Brand -->
        <div class="avatar ml-3 sm:ml-5">
            <div class="w-12 my-1 rounded-full">
                <img src="/img/logoamarta.png" alt="Logo Amarta" />
            </div>
        </div>
    <a href="{{ route('landing-page') }}" class="navbar-brand-font px-3 sm:px-4 text-xl font-semibold tracking-normal">AmartaLib</a>
    </div>

    <!-- Navbar Center (Desktop Menu) -->
    <div class="navbar-center hidden lg:flex">
    <ul class="menu menu-horizontal px-1 font-medium" x-data="{ openDropdown: null }">
            <li><a href="{{ route('landing-page') }}">Beranda</a></li>
            <li>
                <details x-on:click.outside="openDropdown = null" x-bind:open="openDropdown === 'profil'">
                    <summary x-on:click.prevent.stop="openDropdown = openDropdown === 'profil' ? null : 'profil'">Profil</summary>
                    <ul class="w-48 p-2 bg-hijau-light text-white dark:bg-hijau-dark dark:text-white">
                        <li><a href="/profil-perpustakaan#tentang" @click="openDropdown = null">Tentang Perpustakaan</a></li>
                        <li><a href="/profil-perpustakaan#visi" @click="openDropdown = null">Visi & Misi</a></li>
                        <li><a href="/profil-perpustakaan#struktur" @click="openDropdown = null">Struktur Organisasi</a></li>
                        <li><a href="/profil-perpustakaan#staff" @click="openDropdown = null">Staff & Pustakawan</a></li>
                        <li><a href="/profil-perpustakaan#fasilitas" @click="openDropdown = null">Fasilitas</a></li>
                        <li><a href="/profil-perpustakaan#peraturan" @click="openDropdown = null">Peraturan & Tata Tertib</a></li>
                    </ul>
                </details>
            </li>
            <li><a href="https://e-lib.smkn1ciamis.id/">Digilib</a></li>
            <li><a href="{{ route('blog-perpustakaan') }}">Blog</a></li>
            <li><a href="/#kontak">Kontak</a></li>
        </ul>
    </div>

    <!-- Navbar End (Theme Toggle & Button) -->
    <div class="navbar-end flex items-center gap-4 px-2">
        <div class="hidden sm:block">
            <!-- <label class="toggle text-base-content">
                <input type="checkbox" value="synthwave" class="theme-controller" />
                <svg aria-label="sun" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                    <g stroke-linejoin="round" stroke-linecap="round" stroke-width="2" fill="none" stroke="currentColor">
                        <circle cx="12" cy="12" r="4"></circle>
                        <path d="M12 2v2"></path>
                        <path d="M12 20v2"></path>
                        <path d="m4.93 4.93 1.41 1.41"></path>
                        <path d="m17.66 17.66 1.41 1.41"></path>
                        <path d="M2 12h2"></path>
                        <path d="M20 12h2"></path>
                        <path d="m6.34 17.66-1.41 1.41"></path>
                        <path d="m19.07 4.93-1.41 1.41"></path>
                    </g>
                </svg>
                <svg aria-label="moon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                    <g stroke-linejoin="round" stroke-linecap="round" stroke-width="2" fill="none" stroke="currentColor">
                        <path d="M12 3a6 6 0 0 0 9 9 9 9 0 1 1-9-9Z"></path>
                    </g>
                </svg>
            </label> -->
        </div>
    </div>
</div>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Noto+Sans:wght@400;500;600;700&display=swap');

    .navbar-font {
        font-family: 'Noto Sans', sans-serif;
        letter-spacing: 0.1px;
        font-weight: 500;
    }

    .navbar-brand-font {
        font-family: 'Noto Sans', sans-serif;
        letter-spacing: 0.15px;
        font-weight: 700;
    }
</style>

<script>
    tailwind.config = {
        theme: {
            extend: {
                fontFamily: {
                    sans: ['Inter', 'sans-serif'],
                },
            }
        }
    }
</script>
<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>