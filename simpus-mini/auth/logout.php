<?php
if (session_status() === PHP_SESSION_NONE) { session_start(); }
$_SESSION = [];
if (ini_get('session.use_cookies')) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000, $params['path'], $params['domain'], $params['secure'], $params['httponly']);
}
session_destroy();
$scriptName = str_replace('\\', '/', $_SERVER['SCRIPT_NAME'] ?? '');
$segments = explode('/', trim($scriptName, '/'));
$folderIndex = array_search('auth', $segments, true);
$appBase = ($folderIndex !== false && $folderIndex > 0) ? '/' . implode('/', array_slice($segments, 0, $folderIndex)) : '';
header('Location: ' . $appBase . '/auth/login.php');
exit;
