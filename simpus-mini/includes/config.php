<?php
/**
 * SIMPUS-Mini database configuration.
 * Reads EthioDeploy variables: HOST, PORT, DATABASE, USER, PASSWORD.
 * Also supports DB_HOST, DB_PORT, DB_DATABASE, DB_USERNAME, DB_PASSWORD
 * and a local .env file with lowercase keys.
 */

$envFile = dirname(__DIR__) . '/.env';
$envData = [];

if (is_file($envFile) && is_readable($envFile)) {
    $parsed = parse_ini_file($envFile, false, INI_SCANNER_RAW);
    if (is_array($parsed)) {
        $envData = $parsed;
    }
}

$getValue = static function (array $serverKeys, string $fileKey, string $default = '') use ($envData): string {
    // Prefer environment variables provided by the hosting platform.
    foreach ($serverKeys as $key) {
        $value = getenv($key);
        if ($value !== false && $value !== '') {
            return (string) $value;
        }

        if (isset($_ENV[$key]) && $_ENV[$key] !== '') {
            return (string) $_ENV[$key];
        }

        if (isset($_SERVER[$key]) && $_SERVER[$key] !== '') {
            return (string) $_SERVER[$key];
        }
    }

    // Fallback to local .env file.
    if (isset($envData[$fileKey]) && $envData[$fileKey] !== '') {
        return trim((string) $envData[$fileKey]);
    }

    return $default;
};

return [
    'db_host' => $getValue(['HOST', 'DB_HOST'], 'host', 'localhost'),
    'db_port' => $getValue(['PORT', 'DB_PORT'], 'port', '5432'),
    'db_name' => $getValue(['DATABASE', 'DB_DATABASE'], 'database', 'simpus_mini'),
    'db_user' => $getValue(['USER', 'DB_USERNAME'], 'user', 'postgres'),
    'db_pass' => $getValue(['PASSWORD', 'DB_PASSWORD'], 'password', ''),
];
