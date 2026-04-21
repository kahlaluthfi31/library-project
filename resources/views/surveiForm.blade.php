<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Survei Layanan Perpustakaan</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

    <style>
        .form-section {
            transition: all 0.3s ease;
        }

        .form-section:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
        }

        input[type="radio"],
        input[type="checkbox"] {
            accent-color: #2563eb;
        }

        .checkmark {
            transition: all 0.2s ease;
        }

        .option-item:hover .checkmark {
            transform: scale(1.05);
        }
    </style>
</head>

<body class="bg-cover bg-center min-h-screen" style="background-image: url('https://images.unsplash.com/photo-1568667256549-094345857637?q=80&w=2030&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D'); font-family: 'Roboto', sans-serif;">
    <div class="bg-white bg-opacity-80 backdrop-blur-md border border-white/30 rounded-xl px-8 py-10 mx-auto my-12 max-w-3xl shadow-xl">
        <div class="text-center mb-8">
            <h2 class="text-3xl font-bold mb-2 text-blue-800 tracking-tight">SURVEI LAYANAN PERPUSTAKAAN</h2>
            <div class="w-24 h-1 bg-gradient-to-r from-blue-400 to-blue-600 mx-auto rounded-full"></div>
            <p class="text-gray-600 mt-4">Bantu kami meningkatkan layanan dengan mengisi survei ini</p>
        </div>

        @if (session('survey_submitted'))
            <div class="mb-6 rounded-lg bg-green-50 text-green-700 px-4 py-3 text-sm">
                Terima kasih! Jawaban survei Anda sudah berhasil dikirim.
            </div>
        @endif

        <form class="space-y-8" method="POST" action="{{ route('survei-layanan.store') }}">
            @csrf
            <!-- A. Profil Responden -->
            <div class="form-section bg-white/50 p-6 rounded-lg border border-gray-100">
                <h3 class="text-xl font-semibold mb-4 text-blue-700 flex items-center">
                    <span class="bg-blue-100 text-blue-800 p-2 rounded-full mr-3">
                        <i class="fas fa-user-circle text-lg"></i>
                    </span>
                    A. Profil Responden
                </h3>
                <label class="block mb-4 text-gray-700 font-medium">1. Apa status Anda di sekolah ini?</label>
                <div class="space-y-3 pl-2">
                    <label class="option-item flex items-center p-3 rounded-lg hover:bg-blue-50 cursor-pointer transition">
                        <input type="radio" name="respondent_status" value="Siswa" class="mr-3 h-5 w-5" required>
                        <span class="checkmark">Siswa</span>
                    </label>
                    <label class="option-item flex items-center p-3 rounded-lg hover:bg-blue-50 cursor-pointer transition">
                        <input type="radio" name="respondent_status" value="Guru" class="mr-3 h-5 w-5" required>
                        <span class="checkmark">Guru</span>
                    </label>
                    <label class="option-item flex items-center p-3 rounded-lg hover:bg-blue-50 cursor-pointer transition">
                        <input type="radio" name="respondent_status" value="Staf Tata Usaha" class="mr-3 h-5 w-5" required>
                        <span class="checkmark">Staf Tata Usaha</span>
                    </label>
                </div>
            </div>

            <!-- B. Kebutuhan Koleksi -->
            <div class="form-section bg-white/50 p-6 rounded-lg border border-gray-100">
                <h3 class="text-xl font-semibold mb-4 text-blue-700 flex items-center">
                    <span class="bg-blue-100 text-blue-800 p-2 rounded-full mr-3">
                        <i class="fas fa-book-open text-lg"></i>
                    </span>
                    B. Kebutuhan Koleksi
                </h3>
                <label class="block mb-4 text-gray-700 font-medium">2. Jenis koleksi apa yang paling Anda butuhkan? (boleh pilih lebih dari satu)</label>
                <div class="space-y-3 pl-2">
                    <label class="option-item flex items-center p-3 rounded-lg hover:bg-blue-50 cursor-pointer transition">
                        <input type="checkbox" name="needed_collections[]" value="Buku pelajaran sesuai kurikulum SMK" class="mr-3 h-5 w-5 rounded">
                        <span class="checkmark">Buku pelajaran sesuai kurikulum SMK</span>
                    </label>
                    <label class="option-item flex items-center p-3 rounded-lg hover:bg-blue-50 cursor-pointer transition">
                        <input type="checkbox" name="needed_collections[]" value="Buku keterampilan/praktik kejuruan" class="mr-3 h-5 w-5 rounded">
                        <span class="checkmark">Buku keterampilan/praktik kejuruan</span>
                    </label>
                    <label class="option-item flex items-center p-3 rounded-lg hover:bg-blue-50 cursor-pointer transition">
                        <input type="checkbox" name="needed_collections[]" value="Buku pengetahuan/non-fiksi populer" class="mr-3 h-5 w-5 rounded">
                        <span class="checkmark">Buku pengetahuan/non-fiksi populer</span>
                    </label>
                    <label class="option-item flex items-center p-3 rounded-lg hover:bg-blue-50 cursor-pointer transition">
                        <input type="checkbox" name="needed_collections[]" value="Buku fiksi (novel, cerpen, komik)" class="mr-3 h-5 w-5 rounded">
                        <span class="checkmark">Buku fiksi (novel, cerpen, komik)</span>
                    </label>
                    <label class="option-item flex items-center p-3 rounded-lg hover:bg-blue-50 cursor-pointer transition">
                        <input type="checkbox" name="needed_collections[]" value="Koleksi digital (e-book, video edukasi, dll)" class="mr-3 h-5 w-5 rounded">
                        <span class="checkmark">Koleksi digital (e-book, video edukasi, dll)</span>
                    </label>
                </div>
            </div>

            <!-- C. Kebutuhan Layanan -->
            <div class="form-section bg-white/50 p-6 rounded-lg border border-gray-100">
                <h3 class="text-xl font-semibold mb-4 text-blue-700 flex items-center">
                    <span class="bg-blue-100 text-blue-800 p-2 rounded-full mr-3">
                        <i class="fas fa-concierge-bell text-lg"></i>
                    </span>
                    C. Kebutuhan Layanan
                </h3>
                <label class="block mb-4 text-gray-700 font-medium">3. Layanan perpustakaan apa yang paling sering Anda gunakan?</label>
                <div class="space-y-3 pl-2">
                    <label class="option-item flex items-center p-3 rounded-lg hover:bg-blue-50 cursor-pointer transition">
                        <input type="checkbox" name="frequent_services[]" value="Peminjaman dan pengembalian buku" class="mr-3 h-5 w-5 rounded">
                        <span class="checkmark">Peminjaman dan pengembalian buku</span>
                    </label>
                    <label class="option-item flex items-center p-3 rounded-lg hover:bg-blue-50 cursor-pointer transition">
                        <input type="checkbox" name="frequent_services[]" value="Layanan baca di tempat" class="mr-3 h-5 w-5 rounded">
                        <span class="checkmark">Layanan baca di tempat</span>
                    </label>
                    <label class="option-item flex items-center p-3 rounded-lg hover:bg-blue-50 cursor-pointer transition">
                        <input type="checkbox" name="frequent_services[]" value="Layanan internet/Wi-Fi" class="mr-3 h-5 w-5 rounded">
                        <span class="checkmark">Layanan internet/Wi-Fi</span>
                    </label>
                    <label class="option-item flex items-center p-3 rounded-lg hover:bg-blue-50 cursor-pointer transition">
                        <input type="checkbox" name="frequent_services[]" value="Bimbingan literasi informasi/pelatihan" class="mr-3 h-5 w-5 rounded">
                        <span class="checkmark">Bimbingan literasi informasi/pelatihan</span>
                    </label>
                    <label class="option-item flex items-center p-3 rounded-lg hover:bg-blue-50 cursor-pointer transition">
                        <input type="checkbox" name="frequent_services[]" value="Layanan koleksi digital" class="mr-3 h-5 w-5 rounded">
                        <span class="checkmark">Layanan koleksi digital</span>
                    </label>
                </div>
            </div>

            <!-- D. Tingkat Kepuasan -->
            <div class="form-section bg-white/50 p-6 rounded-lg border border-gray-100">
                <h3 class="text-xl font-semibold mb-4 text-blue-700 flex items-center">
                    <span class="bg-blue-100 text-blue-800 p-2 rounded-full mr-3">
                        <i class="fas fa-smile-beam text-lg"></i>
                    </span>
                    D. Tingkat Kepuasan
                </h3>
                <label class="block mb-4 text-gray-700 font-medium">4. Seberapa puas Anda terhadap layanan perpustakaan secara keseluruhan?</label>
                <div class="grid grid-cols-2 gap-3 pl-2">
                    <label class="option-item flex flex-col items-center p-4 rounded-lg hover:bg-blue-50 cursor-pointer transition border border-gray-200">
                        <input type="radio" name="satisfaction" value="Sangat Puas" class="mb-2 h-5 w-5">
                        <span class="checkmark text-center">Sangat Puas</span>
                        <div class="flex mt-1 text-yellow-400">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                    </label>
                    <label class="option-item flex flex-col items-center p-4 rounded-lg hover:bg-blue-50 cursor-pointer transition border border-gray-200">
                        <input type="radio" name="satisfaction" value="Puas" class="mb-2 h-5 w-5">
                        <span class="checkmark text-center">Puas</span>
                        <div class="flex mt-1 text-yellow-400">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                    </label>
                    <label class="option-item flex flex-col items-center p-4 rounded-lg hover:bg-blue-50 cursor-pointer transition border border-gray-200">
                        <input type="radio" name="satisfaction" value="Cukup Puas" class="mb-2 h-5 w-5">
                        <span class="checkmark text-center">Cukup Puas</span>
                        <div class="flex mt-1 text-yellow-400">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                    </label>
                    <label class="option-item flex flex-col items-center p-4 rounded-lg hover:bg-blue-50 cursor-pointer transition border border-gray-200">
                        <input type="radio" name="satisfaction" value="Tidak Puas" class="mb-2 h-5 w-5">
                        <span class="checkmark text-center">Tidak Puas</span>
                        <div class="flex mt-1 text-yellow-400">
                            <i class="fas fa-star"></i>
                        </div>
                    </label>
                </div>
            </div>

            <!-- E. Saran dan Masukan -->
            <div class="form-section bg-white/50 p-6 rounded-lg border border-gray-100">
                <h3 class="text-xl font-semibold mb-4 text-blue-700 flex items-center">
                    <span class="bg-blue-100 text-blue-800 p-2 rounded-full mr-3">
                        <i class="fas fa-lightbulb text-lg"></i>
                    </span>
                    E. Saran dan Masukan
                </h3>
                <label class="block mb-4 text-gray-700 font-medium">5. Apa saran Anda untuk meningkatkan layanan perpustakaan?</label>
                <div class="space-y-3 pl-2">
                    <label class="option-item flex items-center p-3 rounded-lg hover:bg-blue-50 cursor-pointer transition">
                        <input type="checkbox" name="suggestions[]" value="Tambah buku pelajaran dan referensi jurusan" class="mr-3 h-5 w-5 rounded">
                        <span class="checkmark">Tambah buku pelajaran dan referensi jurusan</span>
                    </label>
                    <label class="option-item flex items-center p-3 rounded-lg hover:bg-blue-50 cursor-pointer transition">
                        <input type="checkbox" name="suggestions[]" value="Koleksi digital mudah diakses dari rumah" class="mr-3 h-5 w-5 rounded">
                        <span class="checkmark">Koleksi digital mudah diakses dari rumah</span>
                    </label>
                    <label class="option-item flex items-center p-3 rounded-lg hover:bg-blue-50 cursor-pointer transition">
                        <input type="checkbox" name="suggestions[]" value="Perbanyak koleksi buku fiksi untuk hiburan" class="mr-3 h-5 w-5 rounded">
                        <span class="checkmark">Perbanyak koleksi buku fiksi untuk hiburan</span>
                    </label>
                    <label class="option-item flex items-center p-3 rounded-lg hover:bg-blue-50 cursor-pointer transition">
                        <input type="checkbox" name="suggestions[]" value="Sediakan lebih banyak komputer untuk akses internet" class="mr-3 h-5 w-5 rounded">
                        <span class="checkmark">Sediakan lebih banyak komputer untuk akses internet</span>
                    </label>
                    <label class="option-item flex items-center p-3 rounded-lg hover:bg-blue-50 cursor-pointer transition">
                        <input type="checkbox" name="suggestions[]" value="Tingkatkan kenyamanan ruang baca" class="mr-3 h-5 w-5 rounded">
                        <span class="checkmark">Tingkatkan kenyamanan ruang baca</span>
                    </label>
                    <div class="flex items-start space-x-2 mt-4 p-3 rounded-lg bg-blue-50/50">
                        <input type="checkbox" class="mt-2 ml-1 h-5 w-5 rounded" disabled>
                        <textarea name="other_suggestion" class="w-full resize-none overflow-y-auto h-28 border border-gray-300 p-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent transition" placeholder="Lainnya (tulis saran lain di sini)..."></textarea>
                    </div>
                </div>
            </div>

            <!-- Tombol Submit -->
            <div class="text-center pt-6">
                <button type="submit" class="bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white font-bold px-8 py-3 rounded-lg shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 flex items-center justify-center mx-auto">
                    <i class="fas fa-paper-plane mr-2"></i> Kirim Survei
                </button>
            </div>
        </form>

        
    </div>
</body>

</html>