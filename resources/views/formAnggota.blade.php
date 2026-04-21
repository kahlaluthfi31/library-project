<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Keanggotaan | Perpustakaan Amarta</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        input[type="password"]::-ms-reveal,
        input[type="password"]::-ms-clear {
            display: none;
        }

        /* Custom colors */
        .text-hijau-light {
            color: #031C62;
        }

        .text-hijau-dark {
            color: #021547;
        }

        .bg-hijau-light {
            background-color: #e8ecf8;
        }

        /* Smooth transitions */
        .transition-all {
            transition: all 0.3s ease;
        }

        /* Input focus effects */
        .input-focus:focus {
            box-shadow: 0 0 0 3px rgba(3, 28, 98, 0.2);
            border-color: #031C62;
        }
    </style>
</head>

<body class="bg-gray-50">
    <div id="formSection" class="min-h-screen flex flex-col lg:flex-row">
        <!-- Left: Form Section -->
        <div class="w-full lg:w-1/2 flex items-center justify-center p-4 sm:p-8 bg-white">
            <div class="w-full max-w-md" x-data="{ 
                jenis: '',
                showPassword: false,
                isSubmitting: false 
            }">
                <form action="" id="form" class="space-y-4" @submit.prevent="
                    isSubmitting = true;
                    setTimeout(() => {
                        document.getElementById('toast').classList.remove('hidden');
                        setTimeout(() => {
                            window.location.href = '/';
                        }, 2000);
                    }, 800);
                ">
                    <div class="p-6 sm:p-8">
                        <!-- Logo and Header -->
                        <div class="text-center mb-8">
                            <div class="inline-flex items-center justify-center w-16 h-16 bg-white rounded-full mb-4 shadow-lg">
                                <img src="/img/logoamarta.png" alt="Logo Amarta" class="w-10 h-10">
                            </div>
                            <h1 class="text-3xl font-bold text-hijau-light mb-2">Daftar Keanggotaan</h1>
                            <p class="text-gray-600">Bergabung dengan perpustakaan digital kami</p>
                        </div>

                        <!-- Form Fields -->
                        <div class="space-y-5">
                            <!-- Nama Lengkap -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1.5">Nama Lengkap <span class="text-red-500">*</span></label>
                                <input type="text" required
                                    class="w-full px-4 py-2.5 rounded-lg border border-gray-300 input-focus transition-all placeholder-gray-400"
                                    placeholder="Masukkan nama lengkap">
                            </div>

                            <!-- Jenis Keanggotaan -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1.5">Jenis Keanggotaan <span class="text-red-500">*</span></label>
                                <select x-model="jenis" required
                                    class="w-full px-4 py-2.5 rounded-lg border border-gray-300 input-focus transition-all appearance-none bg-white">
                                    <option value="" disabled selected>Pilih jenis keanggotaan</option>
                                    <option value="siswa">Siswa</option>
                                    <option value="guru">Guru / TU</option>
                                    <option value="umum">Umum</option>
                                </select>
                            </div>

                            <!-- Dynamic ID Field -->
                            <div x-show="jenis" x-transition>
                                <label class="block text-sm font-medium text-gray-700 mb-1.5"
                                    x-text="jenis === 'siswa' ? 'NISN' : (jenis === 'guru' ? 'NIP / NUPTK' : 'NIK') + ' *'"></label>
                                <input type="number" min="1" required
                                    class="w-full px-4 py-2.5 rounded-lg border border-gray-300 input-focus transition-all placeholder-gray-400"
                                    :placeholder="jenis === 'siswa' ? 'Contoh: 1234567890' : (jenis === 'guru' ? 'Contoh: 1234567890' : 'Contoh: 1234567890123')">
                                <p class="text-xs text-gray-500 mt-1" x-text="jenis === 'siswa' ? 'Nomor Induk Siswa Nasional' : (jenis === 'guru' ? 'Nomor Induk Pegawai/NUPTK' : 'Nomor Induk Kependudukan')"></p>
                            </div>

                            <!-- Password -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1.5">Password <span class="text-red-500">*</span></label>
                                <div class="relative">
                                    <input :type="showPassword ? 'text' : 'password'" required
                                        class="w-full px-4 py-2.5 rounded-lg border border-gray-300 input-focus transition-all placeholder-gray-400 pr-10"
                                        placeholder="Minimal 8 karakter">
                                    <button type="button" class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600 transition-colors"
                                        @click="showPassword = !showPassword" tabindex="-1">
                                        <i :class="showPassword ? 'fas fa-eye-slash' : 'fas fa-eye'" class="text-sm"></i>
                                    </button>
                                </div>
                                <p class="text-xs text-gray-500 mt-1">Gunakan kombinasi huruf dan angka</p>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" :disabled="isSubmitting"
                            class="w-full mt-6 bg-[#031C62] hover:bg-[#021547] text-white px-4 py-3 rounded-lg font-semibold transition-all focus:outline-none focus:ring-2 focus:ring-[#031C62] focus:ring-offset-2 disabled:opacity-70 disabled:cursor-not-allowed"
                            :class="{'bg-[#021547]': isSubmitting}">
                            <span x-show="!isSubmitting">Daftar Sekarang</span>
                            <span x-show="isSubmitting" class="inline-flex items-center">
                                <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                                Memproses...
                            </span>
                        </button>
                    </div>
                </form>

                <!-- Toast Notification -->
                <div id="toast" class="fixed top-5 right-5 bg-[#031C62] text-white px-4 py-3 rounded-lg shadow-lg hidden z-50 flex items-center space-x-2 animate-fade-in">
                    <i class="fas fa-check-circle"></i>
                    <span>Terimakasih! Pendaftaran berhasil.</span>
                </div>
            </div>
        </div>

        <!-- Right: Image Section -->
        <div class="hidden lg:block lg:w-1/2 bg-cover bg-center relative"
            style="background-image: url('https://plus.unsplash.com/premium_photo-1664300897489-fd98eee64faf?q=80&w=870&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D')">
            <div class="absolute inset-0 bg-gradient-to-t from-black to-transparent opacity-70"></div>
            <div class="h-full flex items-center justify-center relative z-10 px-12">
                <div class="text-center text-white">
                    <h2 class="text-4xl font-bold mb-4">Perpustakaan Digital Amarta</h2>
                    <p class="text-xl mb-6">Akses ribuan buku digital dan manfaatkan layanan perpustakaan kami</p>
                    <div class="flex justify-center space-x-3">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Simple animation for toast
        document.head.insertAdjacentHTML('beforeend', `
            <style>
                @keyframes fadeIn {
                    from { opacity: 0; transform: translateY(-10px); }
                    to { opacity: 1; transform: translateY(0); }
                }
                .animate-fade-in {
                    animation: fadeIn 0.3s ease-out forwards;
                }
            </style>
        `);
    </script>
</body>

</html>