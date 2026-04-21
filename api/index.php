<?php

// 1. Pindahkan folder storage dan cache ke /tmp (folder yang bisa ditulis di Vercel)
$viewPath = '/tmp/storage/framework/views';
$cachePath = '/tmp/storage/bootstrap/cache';

if (!is_dir($viewPath)) mkdir($viewPath, 0755, true);
if (!is_dir($cachePath)) mkdir($cachePath, 0755, true);

// 2. Paksa Laravel menggunakan path baru tersebut
putenv("VIEW_COMPILED_PATH=$viewPath");
putenv("BOOTSTRAP_CACHE_PATH=$cachePath");

// 3. Jalankan aplikasi seperti biasa
require __DIR__ . '/../public/index.php';
