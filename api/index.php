<?php

// 1. Tentukan path dasar folder sementara
$storagePath = '/tmp/storage';

// 2. Daftar semua folder yang wajib ada agar Laravel tidak komplain
$subDirs = [
    $storagePath . '/framework/views',
    $storagePath . '/framework/cache',
    $storagePath . '/framework/sessions',
    $storagePath . '/bootstrap/cache',
];

// 3. Buat folder secara rekursif
foreach ($subDirs as $dir) {
    if (!is_dir($dir)) {
        mkdir($dir, 0755, true);
    }
}

// 4. Paksa Laravel menggunakan path ini melalui Environment Variable
putenv("APP_STORAGE=$storagePath");
putenv("BOOTSTRAP_CACHE_PATH=$storagePath/bootstrap/cache");

// 5. Jalankan aplikasi
require __DIR__ . '/../public/index.php';
