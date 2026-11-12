<?php
if (session_status() === PHP_SESSION_NONE) { session_start(); }
if ($_SERVER['REQUEST_METHOD'] !== 'POST') { header('Location: register.php'); exit; }
require __DIR__ . '/../includes/koneksi.php';
$nama = trim($_POST['nama'] ?? '');
$username = trim($_POST['username'] ?? '');
$password = $_POST['password'] ?? '';
$konfirmasi = $_POST['konfirmasi_password'] ?? '';
if ($nama === '' || $username === '' || $password === '') {
    $_SESSION['flash'] = ['type'=>'error', 'pesan'=>'Semua kolom wajib diisi.'];
    header('Location: register.php'); exit;
}
if (strlen($username) > 50 || strlen($password) < 6) {
    $_SESSION['flash'] = ['type'=>'error', 'pesan'=>'Username maksimal 50 karakter dan password minimal 6 karakter.'];
    header('Location: register.php'); exit;
}
if ($password !== $konfirmasi) {
    $_SESSION['flash'] = ['type'=>'error', 'pesan'=>'Konfirmasi password tidak sama.'];
    header('Location: register.php'); exit;
}
$cek = $pdo->prepare('SELECT id FROM users WHERE username = :username');
$cek->execute(['username' => $username]);
if ($cek->fetch()) {
    $_SESSION['flash'] = ['type'=>'error', 'pesan'=>'Username sudah digunakan. Silakan pilih username lain.'];
    header('Location: register.php'); exit;
}
$hash = password_hash($password, PASSWORD_DEFAULT);
$stmt = $pdo->prepare("INSERT INTO users (nama, username, password, role) VALUES (:nama, :username, :password, 'petugas')");
$stmt->execute(['nama'=>$nama, 'username'=>$username, 'password'=>$hash]);
$_SESSION['flash'] = ['type'=>'success', 'pesan'=>'Registrasi berhasil. Silakan login.'];
header('Location: login.php'); exit;
