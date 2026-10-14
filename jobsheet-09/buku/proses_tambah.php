<?php

require __DIR__ . '/../includes/koneksi.php';

$judul = trim($_POST['judul'] ?? '');
$pengarang = trim($_POST['pengarang'] ?? '');
$tahun = trim($_POST['tahun'] ?? '');
$isbn = trim($_POST['isbn'] ?? '');
$stok = trim($_POST['stok'] ?? '');
$kategori = trim($_POST['kategori'] ?? '');


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


// INSERT ke database
$stmt = $pdo->prepare(
    "INSERT INTO buku
    (judul, pengarang, tahun, isbn, stok, kategori)
    VALUES
    (:judul, :pengarang, :tahun, :isbn, :stok, :kategori)
    RETURNING id"
);

$stmt->execute([
    'judul' => $judul,
    'pengarang' => $pengarang,
    'tahun' => (int) $tahun,
    'isbn' => $isbn,
    'stok' => (int) $stok,
    'kategori' => $kategori,
]);


// Kembali ke halaman daftar
header('Location: list.php');
exit;