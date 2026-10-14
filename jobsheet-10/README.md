# Jobsheet 10 — Autentikasi & Manajemen Sesi (SIMPUS-Mini)

Project ini melanjutkan Jobsheet 9 dengan menambahkan registrasi, login, logout, session, dan guard halaman.

## Kebutuhan
- PHP dengan extension `pdo_pgsql`
- PostgreSQL
- Database `simpus_mini` beserta tabel `buku` dan `anggota` dari `sql/01_buku_anggota.sql`

## Menjalankan
1. Pastikan konfigurasi PostgreSQL di `includes/koneksi.php` benar.
2. Jalankan tabel akun:
   ```bash
   psql -d simpus_mini -f sql/02_users.sql
   ```
3. Dari folder project, jalankan:
   ```bash
   php -S localhost:8000
   ```
4. Buka `http://localhost:8000/auth/register.php` untuk membuat akun petugas, lalu login.

## Akses halaman
- Publik: `index.php` dan `buku/list.php`.
- Wajib login: semua halaman `anggota/*`, serta tambah/edit/hapus/proses buku.
- Semua akun dari form registrasi diberi role `petugas`. Kontrol khusus admin berdasarkan role merupakan latihan tambahan jobsheet.

## Catatan
Password disimpan menggunakan `password_hash()` dan diperiksa dengan `password_verify()`. Sesi menyimpan `user_id`, `nama`, dan `role`.
