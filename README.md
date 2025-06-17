<div align="center">
  <img src="https://placehold.co/600x200/343a40/ffffff?text=Aplikasi+Fitness+UNPAM" alt="Banner Aplikasi Fitness">
  <h1>Aplikasi Manajemen Fitness</h1>
  <p><strong>Studi Kasus untuk Workshop Pemrograman Web di Universitas Pamulang</strong></p>
  
  <p>
    <img src="https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white" alt="PHP Badge">
    <img src="https://img.shields.io/badge/MySQL-4479A1?style=for-the-badge&logo=mysql&logoColor=white" alt="MySQL Badge">
    <img src="https://img.shields.io/badge/Server-XAMPP-F79920?style=for-the-badge&logo=xampp&logoColor=white" alt="XAMPP Badge">
  </p>
</div>

## 📝 Deskripsi Singkat

Selamat datang di repositori Aplikasi Manajemen Fitness! Proyek ini adalah aplikasi web sederhana yang dibangun menggunakan **PHP** dan **MySQL** sebagai studi kasus untuk kegiatan workshop di **Universitas Pamulang**. Aplikasi ini berfungsi sebagai sistem dasar untuk mengelola data member, paket fitness, dan transaksi di sebuah pusat kebugaran.

Tujuan utama dari proyek ini adalah untuk memberikan pemahaman praktis mengenai pengembangan aplikasi web dengan PHP, mulai dari struktur file, koneksi database, hingga implementasi operasi CRUD (*Create, Read, Update, Delete*).

---

## ✨ Fitur Utama

-   **📊 Dashboard**: Menampilkan ringkasan data total member dan total pendapatan.
-   **👥 Manajemen Member**:
    -   Menambah member baru.
    -   Melihat daftar semua member.
    -   Menghapus data member.
    -   Tanggal kadaluarsa keanggotaan dihitung otomatis berdasarkan paket yang dipilih.
-   **📦 Manajemen Paket**:
    -   Menambah paket fitness baru (misalnya, paket bulanan, 3 bulanan).
    -   Melihat daftar paket yang tersedia.
    -   Menghapus paket.
-   **💳 Manajemen Transaksi**:
    -   Mencatat transaksi baru saat member mendaftar atau memperpanjang keanggotaan.
    -   Melihat riwayat semua transaksi yang telah terjadi.

---

## 🎯 Tujuan Pembelajaran

Setelah mengikuti workshop dan mempelajari kode ini, peserta diharapkan mampu:

1.  Memahami cara kerja aplikasi web berbasis PHP.
2.  Merancang dan membuat database MySQL.
3.  Menghubungkan aplikasi PHP dengan database MySQL.
4.  Menerapkan operasi CRUD untuk mengelola data.
5.  Memahami struktur dasar proyek PHP yang baik.
6.  Mengelola *state* dan alur data antar halaman.

---

## 💻 Teknologi yang Digunakan

* **Backend**: PHP
* **Database**: MySQL / MariaDB
* **Frontend**: HTML & CSS (prosedural/tanpa framework)
* **Server Lokal**: XAMPP

---

## 🚀 Panduan Instalasi dan Setup

Untuk menjalankan aplikasi ini di komputer lokal Anda, ikuti langkah-langkah berikut:

**1. Prasyarat**

Pastikan Anda sudah menginstal **XAMPP** (atau server lokal sejenis seperti WAMP/MAMP) di komputer Anda. XAMPP akan menyediakan Apache (web server) dan MySQL (database).

**2. Clone atau Unduh Repositori**

Buka terminal atau Git Bash, lalu clone repositori ini ke dalam direktori `htdocs` XAMPP Anda.

> ```bash
> # Navigasi ke folder htdocs
> cd C:\xampp\htdocs
>
> # Clone repositori dengan nama folder yang Anda gunakan
> git clone [URL_GITHUB_ANDA] Fitnes_App
> ```

> **Alternatif**: Jika Anda mengunduh file ZIP, ekstrak isinya dan pastikan nama foldernya adalah **`Fitnes_App`** di dalam `C:\xampp\htdocs\`.

**3. Buat dan Impor Database**

* Jalankan modul **Apache** dan **MySQL** dari XAMPP Control Panel.
* Buka browser dan akses `http://localhost/phpmyadmin`.
* Buat database baru dengan nama `fitness`.
* Pilih database `fitness` yang baru dibuat, lalu klik tab **Impor**.
* Pilih file `db_fitness _latihan.sql` (atau nama file SQL yang sesuai) dari folder proyek Anda dan klik **Go** atau **Kirim**. Tabel-tabel akan otomatis dibuat.

**4. Konfigurasi Koneksi**

Buka file `config.php` di dalam folder proyek dan pastikan detail koneksi sudah sesuai (secara default, username `root` dan password kosong).

```php
// config.php
define('DB_NAME', 'fitness'); // Pastikan nama database ini benar
5. Jalankan AplikasiBuka browser Anda dan akses URL berikut untuk melihat aplikasi berjalan:http://localhost/Fitnes_App/⚠️ Troubleshooting: Error "Not Found"Jika Anda mendapatkan error "Not Found", 99% masalahnya adalah nama folder di htdocs tidak sama persis dengan nama yang Anda ketik di URL.🤝 KontribusiMerasa ada yang bisa ditingkatkan? Silakan buat Pull Request atau buka Issue. Kontribusi dalam bentuk apapun sangat kami hargai, terutama untuk perbaikan bug, penambahan fitur, atau peningkatan dokumentasi.📜 LisensiProyek ini dilisensikan di bawah MIT License.