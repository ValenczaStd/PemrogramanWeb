<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

/*
 * Base URL aplikasi.
 * SIMPUS-Mini di-deploy pada: https://domain/simpus-mini/
 * Gunakan URL absolut agar CSS/JS tetap ditemukan dari halaman bertingkat
 * seperti /buku/list.php dan /anggota/edit.php.
 */
$base = '/simpus-mini/';

$cssFile = dirname(__DIR__) . '/assets/css/style.css';
$cssVersion = is_file($cssFile) ? filemtime($cssFile) : time();
?>
<!doctype html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SIMPUS-Mini<?php echo isset($page_title) ? ' | ' . htmlspecialchars($page_title, ENT_QUOTES, 'UTF-8') : ''; ?></title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >
    <link
        rel="stylesheet"
        href="<?php echo $base; ?>assets/css/style.css?v=<?php echo $cssVersion; ?>"
    >
</head>
<body>
<header class="navbar navbar-expand-lg navbar-simpus">
    <div class="container">
        <a class="navbar-brand fw-semibold" href="<?php echo $base; ?>index.php">SIMPUS-Mini</a>

        <button
            class="navbar-toggler"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#navMenu"
            aria-controls="navMenu"
            aria-expanded="false"
            aria-label="Buka navigasi"
        >
            <span class="navbar-toggler-icon"></span>
        </button>

        <nav class="collapse navbar-collapse" id="navMenu">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo $base; ?>index.php">Beranda</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo $base; ?>buku/list.php">Daftar Buku</a>
                </li>

                <?php if (!empty($_SESSION['user_id'])): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo $base; ?>buku/tambah.php">Tambah Buku</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo $base; ?>anggota/list.php">Daftar Anggota</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo $base; ?>anggota/tambah.php">Tambah Anggota</a>
                    </li>
                <?php endif; ?>
            </ul>

            <div class="d-flex align-items-center gap-3 ms-lg-3 mt-3 mt-lg-0">
                <?php if (!empty($_SESSION['user_id'])): ?>
                    <span class="text-white small">
                        <?php echo htmlspecialchars($_SESSION['nama'] ?? 'Petugas', ENT_QUOTES, 'UTF-8'); ?>
                    </span>
                    <a class="auth-status" href="<?php echo $base; ?>auth/logout.php">Logout</a>
                <?php else: ?>
                    <a class="auth-status" href="<?php echo $base; ?>auth/login.php">Login</a>
                <?php endif; ?>
            </div>
        </nav>
    </div>
</header>

<main class="container my-4">
