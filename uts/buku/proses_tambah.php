<?php
require __DIR__ . '/../includes/auth.php';
?>
<?php

require __DIR__ . '/../includes/auth.php';
if ($_SERVER['REQUEST_METHOD'] !== 'POST') { header('Location: tambah.php'); exit; }
require __DIR__ . '/../includes/koneksi.php';

$judul = trim($_POST['judul'] ?? '');
$pengarang = trim($_POST['pengarang'] ?? '');
$tahun = trim($_POST['tahun'] ?? '');
$isbn = trim($_POST['isbn'] ?? '');
$stok = trim($_POST['stok'] ?? '');
$kategori = trim($_POST['kategori'] ?? '');
$harga = trim($_POST['harga'] ?? '');


// Validasi
if ($judul === '') {
    die('Judul wajib diisi.');
}

if ($pengarang === '') {
    die('Pengarang wajib diisi.');
}

if (!is_numeric($tahun)) {
    die('Tahun harus berupa angka.');
}

if (!is_numeric($stok)) {
    die('Stok harus berupa angka.');
}

if (!is_numeric($harga)) {
    die('Harga harus berupa angka.');
}

// INSERT ke database
$stmt = $pdo->prepare(
    "INSERT INTO buku
    (judul, pengarang, tahun, isbn, stok, kategori, harga)
    VALUES
    (:judul, :pengarang, :tahun, :isbn, :stok, :kategori, :harga)
    RETURNING id"
);

$stmt->execute([
    'judul' => $judul,
    'pengarang' => $pengarang,
    'tahun' => (int) $tahun,
    'isbn' => $isbn,
    'stok' => (int) $stok,
    'kategori' => $kategori,
    'harga' => $harga,
]);


// Kembali ke halaman daftar
header('Location: list.php');
exit;