<?php

// 1. Tentukan path folder sementara yang bisa ditulis di Vercel
$storagePath = '/tmp/storage';
$viewPath = $storagePath . '/framework/views';

// 2. Buat folder-folder tersebut secara otomatis jika belum ada
if (!is_dir($viewPath)) {
    mkdir($viewPath, 0755, true);
}

// 3. Paksa Laravel menggunakan folder /tmp untuk menulis Blade Views dan Cache
// Ini yang akan memperbaiki error "Failed to open stream" di gambar kamu
putenv("VIEW_COMPILED_PATH=$viewPath");
putenv("APP_STORAGE=$storagePath");

// 4. Jalankan aplikasi
require __DIR__ . '/../public/index.php';