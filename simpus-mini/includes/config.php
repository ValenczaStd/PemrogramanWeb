<?php
/**
 * Konfigurasi database SIMPUS-Mini.
 *
 * Prioritas sumber konfigurasi:
 * 1. Environment variable server (DB_HOST, DB_PORT, DB_DATABASE,
 *    DB_USERNAME, DB_PASSWORD)
 * 2. File .env di root folder simpus-mini (untuk lokal)
 *
 * Untuk hosting, utamakan environment variables dari dashboard hosting.
 */

$envFile = dirname(__DIR__) . '/.env';
$envData = [];

if (is_file($envFile) && is_readable($envFile)) {
    $parsed = parse_ini_file($envFile, false, INI_SCANNER_RAW);
    if (is_array($parsed)) {
        $envData = $parsed;
    }
}

$getConfigValue = static function (string $serverKey, string $fileKey, string $default = '') use ($envData): string {
    $serverValue = getenv($serverKey);
    if ($serverValue !== false && $serverValue !== '') {
        return $serverValue;
    }

    // Mendukung nama key lama di .env: host, port, database, user, password.
    if (isset($envData[$fileKey]) && $envData[$fileKey] !== '') {
        return trim((string) $envData[$fileKey]);
    }

    return $default;
};

return [
    'db_host' => $getConfigValue('DB_HOST', 'host', 'localhost'),
    'db_port' => $getConfigValue('DB_PORT', 'port', '5432'),
    'db_name' => $getConfigValue('DB_DATABASE', 'database', 'simpus_mini'),
    'db_user' => $getConfigValue('DB_USERNAME', 'user', 'postgres'),
    'db_pass' => $getConfigValue('DB_PASSWORD', 'password', ''),
];
