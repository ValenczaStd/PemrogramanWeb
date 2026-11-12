<?php
/**
 * SIMPUS-Mini database configuration.
 *
 * Prefer DB_* variables to avoid collisions with hosting variables such as PORT.
 * Supports EthioDeploy's HOST / DATABASE / USER / PASSWORD names as fallbacks.
 * For local development, supports lowercase keys in the project-root .env file.
 */

$envFile = dirname(__DIR__) . '/.env';
$envData = [];

if (is_file($envFile) && is_readable($envFile)) {
    $parsed = parse_ini_file($envFile, false, INI_SCANNER_RAW);
    if (is_array($parsed)) {
        $envData = $parsed;
    }
}

$getValue = static function (
    array $serverKeys,
    string $fileKey,
    string $default = ''
) use ($envData): string {
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

    if (isset($envData[$fileKey]) && $envData[$fileKey] !== '') {
        return trim((string) $envData[$fileKey]);
    }

    return $default;
};

return [
    // Prefer explicit DB_* variables. HOST is supported as hosting fallback.
    'db_host' => $getValue(['DB_HOST', 'HOST'], 'host', 'localhost'),

    // IMPORTANT: Never read generic PORT; hosting platforms commonly use PORT=3000.
    'db_port' => $getValue(['DB_PORT'], 'port', '5432'),

    'db_name' => $getValue(['DB_DATABASE', 'DATABASE'], 'database', 'simpus_mini'),
    'db_user' => $getValue(['DB_USERNAME', 'USER'], 'user', 'postgres'),
    'db_pass' => $getValue(['DB_PASSWORD', 'PASSWORD'], 'password', ''),
];
