<?php

// Siapkan direktori writable di /tmp untuk Vercel
$dirs = [
    '/tmp/storage/framework/views',
    '/tmp/storage/framework/cache',
    '/tmp/storage/framework/sessions',
    '/tmp/storage/logs',
];

foreach ($dirs as $dir) {
    if (!is_dir($dir)) {
        mkdir($dir, 0777, true);
    }
}

if (!file_exists('/tmp/database.sqlite')) {
    touch('/tmp/database.sqlite');
}

require __DIR__ . '/../public/index.php';
