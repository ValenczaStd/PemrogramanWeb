<?php
// Pemisahan kredensial dari kode sumber (includes/koneksi.php).
// Di lingkungan produksi/hosting, isi nilai-nilai ini lewat environment
// variable (getenv) yang diatur di server, JANGAN di-commit ke repository
// bila nilai default di bawah sudah diganti dengan kredensial asli.
return [
    'db_host' => getenv('host') ?: 'localhost',
    'db_port' => getenv('port') ?: '5432',
    'db_name' => getenv('database') ?: 'simpus_mini',
    'db_user' => getenv('username') ?: 'postgres',
    'db_pass' => getenv('password') ?: 'postgres',
];
