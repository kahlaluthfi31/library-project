<?php

// Paksa folder storage ke /tmp karena Vercel Read-Only
putenv('APP_STORAGE=/tmp/storage');

// Pastikan folder-folder yang dibutuhkan ada di /tmp
$dirs = [
    '/tmp/storage/framework/views',
    '/tmp/storage/framework/cache',
    '/tmp/storage/framework/sessions',
    '/tmp/storage/bootstrap/cache',
];

foreach ($dirs as $dir) {
    if (!is_dir($dir)) {
        mkdir($dir, 0755, true);
    }
}

require __DIR__ . '/../public/index.php';
