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

---

## ✨ Fitur Utama

-   **🔑 Sistem Login**: Sistem otentikasi admin yang aman menggunakan session dan password hashing.
-   **📊 Dashboard**: Menampilkan ringkasan data total member dan total pendapatan.
-   **👥 Manajemen Member**: Menambah, melihat, dan menghapus data member.
-   **📦 Manajemen Paket**: Menambah, melihat, dan menghapus paket fitness.
-   **💳 Manajemen Transaksi**: Mencatat dan melihat riwayat transaksi.
-   **👑 Manajemen Admin**: Menambah dan menghapus akun admin lainnya.

---

## 🎯 Tujuan Pembelajaran

Setelah mengikuti workshop dan mempelajari kode ini, peserta diharapkan mampu:
1.  Memahami cara kerja aplikasi web berbasis PHP.
2.  Menerapkan sistem login dan manajemen session yang aman.
3.  Menggunakan password hashing untuk keamanan kredensial.
4.  Merancang dan membuat database MySQL.
5.  Menghubungkan aplikasi PHP dengan database MySQL.
6.  Menerapkan operasi CRUD untuk mengelola data.

---

## 💻 Teknologi yang Digunakan

* **Backend**: PHP (dengan Session & Password Hashing)
* **Database**: MySQL / MariaDB
* **Frontend**: HTML & CSS
* **Server Lokal**: XAMPP

---

## 🚀 Panduan Instalasi dan Setup

Untuk menjalankan aplikasi ini di komputer lokal Anda, ikuti langkah-langkah berikut:

**1. Prasyarat**

Pastikan Anda sudah menginstal **XAMPP** di komputer Anda.

**2. Clone atau Unduh Repositori**

Clone repositori ini ke dalam direktori `htdocs` XAMPP Anda.

> ```bash
> # Navigasi ke folder htdocs
> cd C:\xampp\htdocs
>
> # Clone repositori dengan nama folder yang Anda gunakan
> git clone [URL_GITHUB_ANDA] Fitnes_App
> ```

**3. Buat dan Impor Database**

* Jalankan **Apache** dan **MySQL** dari XAMPP Control Panel.
* Buka browser dan akses `http://localhost/phpmyadmin`.
* Buat database baru dengan nama `fitness`.
* Impor file `db_fitness _latihan.sql` ke dalam database `fitness`.

**4. Buat Admin Pertama (Sangat Penting!)**

Karena sekarang ada sistem login, Anda perlu membuat user admin pertama secara manual di database.

* Di phpMyAdmin, buka database `fitness` dan pilih tabel `user_admin`.
* Klik tab **Insert** atau **Sisipkan**.
* Isi form sebagai berikut:
    * `id_user`: Biarkan kosong (auto-increment).
    * `username`: `admin`
    * `password`: Salin dan tempel (paste) hash berikut ini:  
        `$2y$10$3yv9zS3gZpP9wQ8R7jJ4s.Ie8N3d2K5K/r9c7A7T6eY7W9qG0Xz.i`  
        *(Hash ini adalah untuk password "admin123")*
    * `nama_lengkap`: `Administrator Utama`
* Klik **Go** atau **Kirim** untuk menyimpan.

**5. Jalankan Aplikasi**

Buka browser Anda dan akses URL berikut. Anda akan diarahkan ke halaman login.

> `http://localhost/Fitnes_App/`

Gunakan `username: admin` dan `password: admin123` untuk masuk.

---

## 📂 Struktur File Baru

/Fitnes_App│├── login.php           # Halaman login├── logout.php          # Proses logout├── auth_check.php      # Skrip pemeriksa sesi login│├── admins.php          # Halaman manajemen admin├── config.php├── header.php├── footer.php├── index.php├── members.php├── packages.php└── transactions.php
---

## 🤝 Kontribusi

Merasa ada yang bisa ditingkatkan? Silakan buat *Pull Request* atau buka *Issue*.

## 📜 Lisensi

Proyek ini dilisensikan di bawah [MIT License](LICENSE).
