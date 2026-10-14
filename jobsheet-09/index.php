<?php
require __DIR__ . '/includes/koneksi.php';
$page_title = "Beranda";
include __DIR__ . '/includes/header.php';

$totalBuku = $pdo
    ->query("SELECT COUNT(*) FROM buku")
    ->fetchColumn();

$totalAnggota = $pdo
    ->query("SELECT COUNT(*) FROM anggota")
    ->fetchColumn();
?>
      <section class="card shadow-sm mb-4">
        <div class="card-body">
          <h2 class="card-title mb-3 text-brand">
            Selamat Datang di Sistem Perpustakaan Mini
          </h2>
          <p class="mb-0">
            Aplikasi sederhana untuk mengelola data buku dan anggota
            perpustakaan.
          </p>
        </div>
      </section>

      <section class="card shadow-sm mb-4">
        <div class="card-body">
          <div class="row g-3 text-center">
            <div class="col-12 col-lg-3 text-lg-start">
              <h2 class="card-title mb-3 text-brand">Ringkasan</h2>
            </div>
            <div class="col-12 col-sm-6 col-lg-3">
              <div class="stat-card h-100 p-3 rounded-3 bg-body-secondary">
                <h3 class="h6 text-secondary">Total Buku</h3>
                <p class="fs-2 fw-bold mb-0 text-brand"><?php echo $totalBuku; ?></p>
              </div>
            </div>
            <div class="col-12 col-sm-6 col-lg-3">
              <div class="stat-card h-100 p-3 rounded-3 bg-body-secondary">
                <h3 class="h6 text-secondary">Total Anggota</h3>
                <p class="fs-2 fw-bold mb-0 text-brand"><?php echo $totalAnggota; ?></p>
              </div>
            </div>
            <div class="col-12 col-sm-6 col-lg-3">
              <div class="stat-card h-100 p-3 rounded-3 bg-body-secondary">
                <h3 class="h6 text-secondary">Sedang Dipinjam</h3>
                <p class="fs-2 fw-bold mb-0 text-brand">3</p>
              </div>
            </div>
            <div class="col-12 col-sm-6 col-lg-3">
              <div class="stat-card h-100 p-3 rounded-3 bg-body-secondary">
                <h3 class="h6 text-secondary">Buku Terlambat</h3>
                <p class="fs-2 fw-bold mb-0 text-brand">1</p>
              </div>
            </div>
          </div>
        </div>
      </section>
<?php include __DIR__ . '/includes/footer.php'; ?>
