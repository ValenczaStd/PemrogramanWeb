<?php
// Mulai session hanya jika belum aktif.
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Tentukan prefix URL project agar tetap bekerja jika project berada di subfolder.
$scriptName = str_replace('\\', '/', $_SERVER['SCRIPT_NAME'] ?? '');
$segments = explode('/', trim($scriptName, '/'));
$knownFolders = ['buku', 'anggota', 'auth'];
$folderIndex = null;
foreach ($segments as $i => $segment) {
    if (in_array($segment, $knownFolders, true)) { $folderIndex = $i; break; }
}
$appBase = $folderIndex === null ? '' : ($folderIndex > 0 ? '/' . implode('/', array_slice($segments, 0, $folderIndex)) : '');

if (empty($_SESSION['user_id'])) {
    header('Location: ' . $appBase . '/auth/login.php');
    exit;
}
