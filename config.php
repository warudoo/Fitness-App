<?php
// MUHAMAD SALWARUD 221011401371
// 06TPLP027
// Aplikasi Manajemen Fitness

session_start();

// Pengaturan Database
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'fitness');

// Membuat koneksi ke database menggunakan MySQLi
$conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi Database Gagal: " . $conn->connect_error);
}

// Mengatur zona waktu default
date_default_timezone_set('Asia/Jakarta');

// Fungsi untuk memformat harga menjadi format Rupiah
function format_rupiah($angka){
	$hasil_rupiah = "Rp " . number_format($angka,0,',','.');
	return $hasil_rupiah;
}
?>
