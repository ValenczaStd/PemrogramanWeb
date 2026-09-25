# FYI

Saya bingung untuk pengerjaan jobsheet ini, karena tidak ada langkah langkahnya, jadi saya menyimpulkan bahwa html yang tadi nya belum memamakai library booststrap di migrasi dengan memakai booststrap, jadi seperti ini langsung

# SIMPUS-Mini

Aplikasi web sederhana untuk mengelola data buku dan anggota perpustakaan. Proyek ini dibuat sebagai bagian dari **Jobsheet 3 (Bootstrap)** dan hanya berupa tampilan statis (HTML, CSS, dan Bootstrap), tanpa backend dan database.

## Fitur

- **Beranda**: ucapan selamat datang dan ringkasan (total buku, total anggota, sedang dipinjam, buku terlambat).
- **Daftar Buku**: tabel buku dengan judul, pengarang, tahun, stok, badge status ketersediaan, dan tombol aksi (Edit, Detail, Hapus).
- **Tambah Buku**: formulir input judul, pengarang, tahun terbit, ISBN, stok, dan kategori.
- **Daftar Anggota**: tabel anggota dengan nomor anggota, nama, alamat, nomor HP, dan tombol aksi (Edit, Hapus).
- **Tambah Anggota**: formulir input nama, nomor anggota, alamat, dan nomor HP.
- **Responsif**: tampilan menyesuaikan layar desktop maupun ponsel, dengan navbar yang berubah menjadi menu hamburger di layar kecil.

## Teknologi

- HTML5
- [Bootstrap 5.3.3](https://getbootstrap.com/) (dimuat lewat CDN jsDelivr)
- CSS kustom (`assets/css/style.css`) untuk tema warna

## Struktur Folder

```
jobsheet-03-Bootstrap/
├── index.html
├── assets/
│   └── css/
│       └── style.css
├── buku/
│   ├── list.html
│   └── tambah.html
└── anggota/
    ├── list.html
    └── tambah.html
```

## Cara Menjalankan

1. Salin atau clone folder proyek ke komputer Anda.
2. Jika memakai XAMPP/Laragon, letakkan folder di `htdocs` (atau `www`), lalu buka:

   ```
   http://localhost/jobsheet-03-Bootstrap/index.html
   ```

3. Tanpa web server, cukup buka `index.html` langsung di browser (klik dua kali).

> **Catatan:** Bootstrap dimuat dari CDN, jadi perangkat perlu terhubung ke internet saat membuka halaman.

## Kustomisasi Tema

Seluruh warna dan gaya tambahan berada di `assets/css/style.css`. File HTML tidak memakai atribut `style="..."`, hanya class Bootstrap dan class kustom berikut:

| Class | Fungsi |
| --- | --- |
| `navbar-simpus` | Warna latar dan teks navbar |
| `text-brand` | Warna teks utama (judul dan angka ringkasan) |
| `stat-card` | Latar kartu ringkasan di beranda |
| `table-brand` | Warna header tabel |
| `btn-brand` | Tombol utama (misalnya tombol Simpan) |

Untuk mengganti warna tema, ubah variabel di bagian `:root` pada `style.css`:

```css
:root {
  --simpus-primary: #39ff14;       /* warna utama */
  --simpus-primary-dark: #2bd10c;  /* warna hover/active */
  --simpus-on-primary: #1b1b1b;    /* warna teks di atas warna utama */
  --simpus-stat-bg: #eef4fa;       /* latar kartu ringkasan */
}
```

## Catatan Pengembangan

- Tombol Edit, Detail, dan Hapus serta tombol Simpan pada formulir belum memiliki fungsi karena proyek ini baru berfokus pada tampilan.
- Data pada tabel dan ringkasan masih berupa data contoh (statis).
- Jangan menambahkan reset global seperti `* { margin: 0; padding: 0; }` atau aturan untuk elemen `header`, `section`, `table`, dan `form` di `style.css`, karena akan bentrok dengan Bootstrap.

## Penulis

- Nama: _(isi nama Anda)_
- NIM: _(isi NIM Anda)_
- Mata kuliah / Jobsheet: Jobsheet 3 (Bootstrap)