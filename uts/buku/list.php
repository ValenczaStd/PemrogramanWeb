<?php
require __DIR__ . '/../includes/koneksi.php';
$page_title = "Daftar Buku";
include __DIR__ . '/../includes/header.php';
$flash = $_SESSION['flash'] ?? null;
unset($_SESSION['flash']);
$q = trim($_GET['q'] ?? '');
$page = max(1, (int)($_GET['page'] ?? 1));
$perPage = 5;
$where = $q !== '' ? " WHERE judul ILIKE :kw OR pengarang ILIKE :kw" : '';
$countStmt = $pdo->prepare("SELECT COUNT(*) FROM buku" . $where);
if ($q !== '') $countStmt->execute(['kw' => "%$q%"]);
else $countStmt->execute();
$total = (int)$countStmt->fetchColumn();
$totalPages = max(1, (int)ceil($total / $perPage));
$page = min($page, $totalPages);
$offset = ($page - 1) * $perPage;
$sql = "SELECT * FROM buku" . $where . " ORDER BY id DESC LIMIT :lim OFFSET :off";
$stmt = $pdo->prepare($sql);
if ($q !== '') $stmt->bindValue(':kw', "%$q%", PDO::PARAM_STR);
$stmt->bindValue(':lim', $perPage, PDO::PARAM_INT);
$stmt->bindValue(':off', $offset, PDO::PARAM_INT);
$stmt->execute();
$daftarBuku = $stmt->fetchAll();
function h($v)
{
    return htmlspecialchars((string)$v, ENT_QUOTES, 'UTF-8');
}
?>
<section class="card shadow-sm mb-4">
    <div class="card-body">

        <!--
            MODIFIKASI UTS: FILTER STATUS STOK
            Fungsi:
            - Memilih semua buku, buku tersedia, atau stok habis.
            - Penyaringan dilakukan oleh JavaScript tanpa query database baru.
        -->
        <div class="row mb-3">
            <div class="col-md-4">
                <label for="filterStok" class="form-label">
                    Filter Status Stok
                </label>
                <select id="filterStok" class="form-select">
                    <option value="semua">Semua Buku</option>
                    <option value="tersedia">Stok Tersedia</option>
                    <option value="habis">Stok Habis</option>
                </select>
            </div>
        </div>

        <h2 class="card-title mb-3 text-brand">Daftar Buku</h2>
        <?php if ($flash): ?>
            <p class="flash flash-<?php echo h($flash['type']); ?>">
                <?php echo h($flash['pesan']); ?>
            </p>
        <?php endif; ?>
        <form class="search-box mb-3" method="get" action="list.php">
            <label for="search-input">Cari Judul atau Pengarang Buku</label>
            <div class="input-group">
                <input class="form-control" type="text" id="search-input" name="q" value="<?php echo h($q); ?>" placeholder="Ketik judul/pengarang...">
                <button class="btn btn-brand" type="submit">
                    Cari
                </button>
                <?php if ($q !== ''): ?>
                    <a class="btn btn-outline-secondary" href="list.php">
                        Reset
                    </a>
                <?php endif; ?>
            </div>
        </form>
        <div class="table-responsive">
            <table class="table table-striped table-hover align-middle">
                <thead class="table-brand">
                    <tr>
                        <th>Judul</th>
                        <th>Pengarang</th>
                        <th>Tahun</th>
                        <th>Stok</th>
                        <th>Kategori</th>
                        <th>Harga</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!$daftarBuku): ?>
                        <tr>
                            <td colspan="7">Data buku tidak ditemukan.</td>
                        </tr>
                        <?php else: foreach ($daftarBuku as $buku): ?>
                            <!--
                                MODIFIKASI UTS:
                                Atribut data-stok menyimpan nilai stok buku
                                agar bisa dibaca oleh JavaScript.
                            -->
                            <tr data-stok="<?php echo (int) $buku['stok']; ?>">
                                <td>
                                    <?php echo $buku['judul']; ?>
                                </td>
                                <td>
                                    <?php echo $buku['pengarang']; ?>
                                </td>
                                <td>
                                    <?php echo $buku['tahun']; ?>
                                </td>
                                <td>
                                    <?php if ((int) $buku['stok'] > 0): ?>
                                        <span class="badge bg-primary">
                                            Tersedia (<?php echo (int) $buku['stok']; ?>)
                                        </span>
                                    <?php else: ?>
                                        <span class="badge bg-danger">
                                            Stok Habis
                                        </span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php echo $buku['kategori']; ?>
                                </td>
                                <td>
                                    <?php echo $buku['harga']; ?>
                                </td>
                                <td>
                                    <a class="btn btn-sm btn-outline-primary btn-edit" href="edit.php?id=<?php echo (int)$buku['id']; ?>">
                                        Edit
                                    </a>
                                    <form class="form-hapus d-inline" method="post" action="hapus.php">
                                        <input type="hidden" name="id" value="<?php echo (int)$buku['id']; ?>">
                                        <button type="submit" class="btn btn-sm btn-outline-danger btn-hapus" data-nama="<?php echo h($buku['judul']); ?>">
                                            Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                    <?php endforeach;
                    endif; ?>
                </tbody>
            </table>
        </div>

        
        <!--
            MODIFIKASI UTS:
            ID infoJumlah digunakan JavaScript untuk memperbarui
            jumlah buku yang terlihat setelah filter diterapkan.
        -->
        <p id="infoJumlah">
            Menampilkan <?php echo count($daftarBuku); ?>
            dari <?php echo $total; ?> data.
        </p>

        
        
        <?php if ($totalPages > 1): ?>
            <nav aria-label="Navigasi halaman">
                <ul class="pagination">
                    <li class="page-item <?php echo $page <= 1 ? 'disabled' : ''; ?>">
                        <a class="page-link" href="?q=<?php echo urlencode($q); ?>&page=<?php echo max(1, $page - 1); ?>">
                            Sebelumnya
                        </a>
                    </li>
                    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                        <li class="page-item <?php echo $i === $page ? 'active' : ''; ?>">
                            <a class="page-link" href="?q=<?php echo urlencode($q); ?>&page=<?php echo $i; ?>">
                                <?php echo $i; ?>
                            </a>
                        </li>
                    <?php endfor; ?>
                    <li class="page-item <?php echo $page >= $totalPages ? 'disabled' : ''; ?>">
                        <a class="page-link" href="?q=<?php echo urlencode($q); ?>&page=<?php echo min($totalPages, $page + 1); ?>">
                            Berikutnya
                        </a>
                    </li>
                </ul>
            </nav>
        <?php endif; ?>
    </div>

    <script>
        /*
         * MODIFIKASI UTS: FILTER STOK DENGAN JAVASCRIPT
         *
         * Tujuan:
         * Menampilkan buku berdasarkan status stok yang dipilih.
         *
         */

        // Mengambil elemen filter dan informasi hasil.
        const filterStok = document.getElementById('filterStok');
        const infoFilter = document.getElementById('infoFilter');
        const infoJumlah = document.getElementById('infoJumlah');

        // Fungsi utama untuk memfilter buku.
        function terapkanFilterStok() {
            // Membaca pilihan pengguna dari dropdown.
            const statusDipilih = filterStok.value;

            // Mengambil semua baris data buku.
            const semuaBaris = document.querySelectorAll(
                'tbody tr[data-stok]'
            );

            // Variabel penghitung buku yang ditampilkan.
            let jumlahTampil = 0;

            // Memeriksa setiap baris buku.
            semuaBaris.forEach(function(baris) {
                // Mengubah nilai stok menjadi angka.
                const stok = baris.dataset.stok;

                // Awalnya, baris dianggap sesuai filter.
                let tampilkan = true;

                // Jika pengguna memilih buku tersedia.
                if (statusDipilih == 'tersedia') {
                    tampilkan = stok > 0;
                }

                // Jika pengguna memilih stok habis.
                else if (statusDipilih == 'habis') {
                    tampilkan = stok <= 0;
                }

                // Menampilkan atau menyembunyikan baris.
                if (tampilkan) {
                    baris.style.display = '';
                    jumlahTampil++;
                } else {
                    baris.style.display = 'none';
                }
            });

            infoJumlah.textContent =
                'Menampilkan ' + jumlahTampil +
                ' dari ' + semuaBaris.length +
                ' buku pada halaman ini.';

            // Memperbarui informasi jumlah buku yang tampil.
            infoFilter.textContent =
                'Menampilkan ' + jumlahTampil +
                ' dari ' + semuaBaris.length +
                ' buku pada halaman ini.';
        }

        // Menjalankan filter saat pilihan dropdown berubah.
        filterStok.addEventListener(
            'change',
            terapkanFilterStok
        );
    </script>
</section>

<?php include __DIR__ . '/../includes/footer.php'; ?>