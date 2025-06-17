Aplikasi Manajemen Fitness (Studi Kasus Workshop Universitas Pamulang)
Deskripsi Singkat
Selamat datang di repositori Aplikasi Manajemen Fitness! Proyek ini adalah aplikasi web sederhana yang dibangun menggunakan PHP dan MySQL sebagai studi kasus untuk kegiatan workshop di Universitas Pamulang. Aplikasi ini berfungsi sebagai sistem dasar untuk mengelola data member, paket fitness, dan transaksi di sebuah pusat kebugaran.

Tujuan dari proyek ini adalah untuk memberikan pemahaman dasar mengenai pengembangan aplikasi web dengan PHP, mulai dari struktur file, koneksi database, hingga operasi CRUD (Create, Read, Update, Delete).

Fitur Utama
Aplikasi ini memiliki beberapa fitur inti, antara lain:

Dashboard: Menampilkan ringkasan data total member dan total pendapatan.

Manajemen Member:

Menambah member baru.

Melihat daftar semua member.

Menghapus data member.

Tanggal kadaluarsa keanggotaan dihitung otomatis berdasarkan paket yang dipilih.

Manajemen Paket:

Menambah paket fitness baru (misalnya, paket bulanan, 3 bulanan).

Melihat daftar paket yang tersedia.

Menghapus paket.

Manajemen Transaksi:

Mencatat transaksi baru saat member mendaftar atau memperpanjang keanggotaan.

Melihat riwayat semua transaksi yang telah terjadi.

Teknologi yang Digunakan
Backend: PHP

Database: MySQL / MariaDB

Frontend: HTML & CSS (prosedural/tanpa framework)

Server Lokal: XAMPP

Panduan Instalasi dan Setup
Untuk menjalankan aplikasi ini di komputer lokal Anda, ikuti langkah-langkah berikut:

1. Prasyarat

Pastikan Anda sudah menginstal XAMPP (atau server lokal sejenis seperti WAMP/MAMP) di komputer Anda. XAMPP akan menyediakan Apache (web server) dan MySQL (database).

2. Clone Repositori

Buka terminal atau Git Bash, lalu clone repositori ini ke dalam direktori htdocs XAMPP Anda.

# Navigasi ke folder htdocs
cd C:\xampp\htdocs

# Clone repositori
git clone [URL_GITHUB_ANDA] "Fitnes App"

Catatan: Jika Anda mengunduh file ZIP, ekstrak isinya dan letakkan folder Fitnes App di dalam C:\xampp\htdocs\.

3. Buat dan Impor Database

Jalankan modul Apache dan MySQL dari XAMPP Control Panel.

Buka browser dan akses http://localhost/phpmyadmin.

Buat database baru dengan nama fitness.

Pilih database fitness yang baru dibuat, lalu klik tab Impor.

Pilih file db_fitness _latihan.sql (atau nama file SQL yang sesuai) dari folder proyek Anda dan klik Go atau Kirim. Tabel-tabel akan otomatis dibuat.

4. Konfigurasi Koneksi

Buka file `config.php
