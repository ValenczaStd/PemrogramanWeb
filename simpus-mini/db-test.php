
<?php

$config = require __DIR__ . '/includes/config.php';

echo "Konfigurasi terbaca.<br>";
echo "Host: " . htmlspecialchars($config['db_host']) . "<br>";

try {
    $dsn = "pgsql:"
         . "host={$config['db_host']};"
         . "port={$config['db_port']};"
         . "dbname={$config['db_name']};"
         . "connect_timeout=5;"
         . "sslmode=require";

    $pdo = new PDO(
        $dsn,
        $config['db_user'],
        $config['db_pass'],
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        ]
    );

    echo "<h2>BERHASIL TERHUBUNG KE SUPABASE</h2>";

    echo "PostgreSQL Version: ";
    echo $pdo->query("SELECT version()")->fetchColumn();

} catch (Throwable $e) {
    http_response_code(500);
    echo "<h2>KONEKSI GAGAL</h2>";
    echo htmlspecialchars($e->getMessage());
}
