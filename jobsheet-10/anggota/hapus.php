<?php
require __DIR__ . '/../includes/auth.php';
?>
<?php
require __DIR__ . '/../includes/koneksi.php';

if ($_SESSION['role'] !== 'admin') {
    echo "<script>
        alert('Anda tidak memiliki akses untuk menghapus anggota!');
        window.location.href = 'list.php';
    </script>";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: list.php');
    exit;
}
$id = (int)($_POST['id'] ?? 0);
if ($id <= 0) {
    $_SESSION['flash'] = ['type' => 'error', 'pesan' => 'ID anggota tidak valid.'];
    header('Location: list.php');
    exit;
}
$stmt = $pdo->prepare('DELETE FROM anggota WHERE id=:id');
$stmt->execute(['id' => $id]);
if ($stmt->rowCount() > 0) {
    $_SESSION['flash'] = ['type' => 'success', 'pesan' => 'Anggota berhasil dihapus.'];
} else {
    $_SESSION['flash'] = ['type' => 'error', 'pesan' => 'Data anggota tidak ditemukan.'];
}
header('Location: list.php');
exit;
?>