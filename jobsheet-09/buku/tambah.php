<?php
$page_title = "Tambah Buku";
include __DIR__ . '/../includes/header.php';
$flash = $_SESSION['flash'] ?? null;
unset($_SESSION['flash']);
?>
      <section class="card shadow-sm mb-4">
        <div class="card-body">
          <h2 class="card-title mb-3 text-brand">Tambah Buku</h2>
          <?php if ($flash): ?>
          <p class="flash flash-<?php echo $flash['type']; ?>"><?php echo $flash['pesan']; ?></p>
          <?php endif; ?>
          <form id="form-tambah" method="post" action="proses_tambah.php">
            <div class="mb-3">
              <label for="judul" class="form-label fw-semibold">Judul</label>
              <input
                type="text"
                class="form-control"
                id="judul"
                name="judul"
                required
              />
            </div>
            <div class="mb-3">
              <label for="pengarang" class="form-label fw-semibold"
                >Pengarang</label
              >
              <input
                type="text"
                class="form-control"
                id="pengarang"
                name="pengarang"
                required
              />
            </div>
            <div class="mb-3">
              <label for="tahun" class="form-label fw-semibold"
                >Tahun Terbit</label
              >
              <input
                type="number"
                class="form-control"
                id="tahun"
                name="tahun"
                min="1900"
                max="2026"
                required
              />
            </div>
            <div class="mb-3">
              <label for="isbn" class="form-label fw-semibold">ISBN</label>
              <input type="text" class="form-control" id="isbn" name="isbn" />
            </div>
            <div class="mb-3">
              <label for="stok" class="form-label fw-semibold">Stok</label>
              <input
                type="number"
                class="form-control"
                id="stok"
                name="stok"
                min="0"
                required
              />
            </div>
            <div class="mb-3">
              <label for="kategori" class="form-label fw-semibold"
                >Kategori</label
              >
              <select class="form-select" id="kategori" name="kategori">
                <option value="fiksi">Fiksi</option>
                <option value="non-fiksi">Non-Fiksi</option>
                <option value="referensi">Referensi</option>
              </select>
            </div>
            <button type="submit" class="btn btn-brand">Simpan</button>
          </form>
        </div>
      </section>
<?php include __DIR__ . '/../includes/footer.php'; ?>
