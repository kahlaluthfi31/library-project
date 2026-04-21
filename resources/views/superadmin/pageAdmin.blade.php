<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Amarta Library</title>
    @vite('resources/css/app.css')
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            50: '#f0fdf4',
                            600: '#16a34a', // Warna hijau Amarta
                        },
                        dark: {
                            800: '#1e293b',
                            900: '#0f172a',
                        }
                    },
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    },
                }
            }
        }
    </script>
    <style>
        .active-nav {
            background-color: rgba(255, 255, 255, 0.1);
            border-left: 4px solid #16a34a;
        }
    </style>
</head>

<body class="bg-gray-50 font-sans">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <aside class="w-64 bg-dark-900 text-white shadow-lg">
            <!-- Logo -->
            <div class="p-4 border-b border-gray-800 flex items-center space-x-2">
                <div class="w-8 h-8 bg-primary-600 rounded-full flex items-center justify-center">
                    <i class="fas fa-book text-white text-sm"></i>
                </div>
                <span class="font-bold">Amarta <span class="text-green-400">Super admin</span></span>
            </div>

            <!-- Menu Navigasi -->
            <nav class="p-4 space-y-1" id="sidebar-nav">
                <a href="#" class="nav-link flex items-center p-3 rounded-lg text-white bg-gray-700">
                    <i class="fas fa-tachometer-alt mr-3 w-5 text-center"></i>
                    Dashboard
                </a>

                <div class="mt-4 text-xs font-semibold text-gray-400 uppercase tracking-wider pl-3">Konten</div>

                <a href="#" class="nav-link flex items-center p-3 rounded-lg text-gray-300 hover:bg-gray-800">
                    <i class="fas fa-newspaper mr-3 w-5 text-center"></i>
                    Berita/Blog
                </a>

                <a href="#" class="nav-link flex items-center p-3 rounded-lg text-gray-300 hover:bg-gray-800">
                    <i class="fas fa-sitemap mr-3 w-5 text-center"></i>
                    Struktur Organisasi
                </a>

                <div class="mt-4 text-xs font-semibold text-gray-400 uppercase tracking-wider pl-3">Layanan</div>

                <a href="#" class="nav-link flex items-center p-3 rounded-lg text-gray-300 hover:bg-gray-800">
                    <i class="fas fa-poll mr-3 w-5 text-center"></i>
                    Survei Layanan
                </a>

                <a href="#" class="nav-link flex items-center p-3 rounded-lg text-gray-300 hover:bg-gray-800">
                    <i class="fas fa-comment-dots mr-3 w-5 text-center"></i>
                    Kritik & Saran
                </a>
            </nav>

            <!-- User Profile -->
            <div class="absolute bottom-0 w-64 p-4 border-t border-gray-800">
                <div class="flex items-center">
                    <img class="w-9 h-9 rounded-full" src="https://randomuser.me/api/portraits/men/32.jpg" alt="Admin">
                    <div class="ml-3">
                        <p class="text-sm font-medium">Super Admin</p>
                        <p class="text-xs text-gray-400">admin@amartalib.id</p>
                    </div>
                </div>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 overflow-y-auto">
            <!-- Header -->
            <header class="bg-white shadow-sm p-4">
                <div class="flex justify-between items-center">
                    <h1 class="text-xl font-semibold text-gray-800">Dashboard</h1>
                    <div class="flex items-center space-x-4">
                        <button class="p-2 rounded-full hover:bg-gray-100">
                            <i class="fas fa-bell text-gray-500"></i>
                        </button>
                        <div class="flex items-center">
                            <img class="w-8 h-8 rounded-full" src="https://randomuser.me/api/portraits/men/32.jpg" alt="User">
                        </div>
                    </div>
                </div>
            </header>

            <!-- Content Area -->
            <div class="p-6">
                <!-- Stat Cards -->
                <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
                    <div class="bg-white p-6 rounded-lg shadow">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-blue-100 text-blue-600 mr-4">
                                <i class="fas fa-newspaper"></i>
                            </div>
                            <div>
                                <p class="text-gray-500 text-sm">Total Berita</p>
                                <p class="text-2xl font-bold text-black">24</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white p-6 rounded-lg shadow">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-green-100 text-green-600 mr-4">
                                <i class="fas fa-users"></i>
                            </div>
                            <div>
                                <p class="text-gray-500 text-sm">Total Staff</p>
                                <p class="text-2xl font-bold text-black">12</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white p-6 rounded-lg shadow">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-yellow-100 text-yellow-600 mr-4">
                                <i class="fas fa-poll"></i>
                            </div>
                            <div>
                                <p class="text-gray-500 text-sm">Survei Terisi</p>
                                <p class="text-2xl font-bold text-black">143</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white p-6 rounded-lg shadow">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-purple-100 text-purple-600 mr-4">
                                <i class="fas fa-comments"></i>
                            </div>
                            <div>
                                <p class="text-gray-500 text-sm">Kritik & Saran</p>
                                <p class="text-2xl font-bold text-black">28</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Recent Content -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <!-- Berita Terbaru -->
                    <div class="bg-white rounded-lg shadow overflow-hidden">
                        <div class="p-4 border-b border-gray-200 flex justify-between items-center">
                            <h2 class="font-semibold text-black text-lg">Berita Terbaru</h2>
                            <a href="#" class="text-sm text-primary-600 hover:underline">Lihat Semua</a>
                        </div>
                        <div class="divide-y divide-gray-200">
                            <!-- Berita Item -->
                            <div class="p-4 hover:bg-gray-50">
                                <div class="flex justify-between">
                                    <h3 class="font-medium text-black">Pelatihan Literasi Digital</h3>
                                    <span class="text-xs text-gray-500">2 hari lalu</span>
                                </div>
                                <p class="text-sm text-gray-500 mt-1">Pelatihan untuk meningkatkan kemampuan literasi digital...</p>
                                <div class="flex mt-3 space-x-2">
                                    <button class="text-xs px-2 py-1 bg-blue-100 text-blue-600 rounded">Edit</button>
                                    <button class="text-xs px-2 py-1 bg-red-100 text-red-600 rounded">Hapus</button>
                                </div>
                            </div>
                            <!-- More items... -->
                        </div>
                    </div>

                    <!-- Hasil Survei -->
                    <div class="bg-white rounded-lg shadow overflow-hidden">
                        <div class="p-4 border-b border-gray-200">
                            <h2 class="font-semibold text-black text-lg">Hasil Survei Terbaru</h2>
                        </div>
                        <div class="p-4">
                            <div class="h-64 flex items-center justify-center">
                                <div class="text-center">
                                    <i class="fas fa-chart-pie text-4xl text-gray-300 mb-2"></i>
                                    <p class="text-gray-500">Grafik hasil survei akan muncul di sini</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Kritik & Saran -->
                    <div class="bg-white rounded-lg shadow overflow-hidden lg:col-span-2">
                        <div class="p-4 border-b border-gray-200 flex justify-between items-center">
                            <h2 class="font-semibold text-lg text-black">Kritik & Saran Terbaru</h2>
                            <a href="#" class="text-sm text-primary-600 hover:underline">Lihat Semua</a>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Pengirim</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Isi</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tanggal</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-black">user123</td>
                                        <td class="px-6 py-4 text-sm text-gray-500">Koleksi buku teknologi perlu diperbarui...</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">15 Jun 2023</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-800">Dibaca</span>
                                        </td>
                                    </tr>
                                    <!-- More rows... -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
    <!-- script untuk active-nav di nav -->
    <script>
        // Ambil semua link dengan class 'nav-link'
        const navLinks = document.querySelectorAll('#sidebar-nav .nav-link');

        navLinks.forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault(); // Mencegah reload halaman jika pakai href="#"

                // Hapus class active-nav dari semua link
                navLinks.forEach(item => {
                    item.classList.remove('text-white', 'bg-gray-700');
                    item.classList.add('text-gray-300');
                });

                // Tambahkan class active ke link yang diklik
                this.classList.add('text-white', 'bg-gray-700');
                this.classList.remove('text-gray-300');
            });
        });
    </script>
</body>

</html>