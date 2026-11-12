<?php
// Pemisahan kredensial dari kode sumber (includes/koneksi.php).
// Di lingkungan produksi/hosting, isi nilai-nilai ini lewat environment
// variable (getenv) yang diatur di server, JANGAN di-commit ke repository
// bila nilai default di bawah sudah diganti dengan kredensial asli.
return [
    'db_host' => getenv('DB_HOST') ?: 'localhost',
    'db_port' => getenv('DB_PORT') ?: '5432',
    'db_name' => getenv('DB_DATABASE') ?: 'simpus_mini',
    'db_user' => getenv('DB_USERNAME') ?: 'postgres',
    'db_pass' => getenv('DB_PASSWORD') ?: 'postgres',
];
