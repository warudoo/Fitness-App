<?php
// MUHAMAD SALWARUD 221011401371
// 06TPLP027
// Aplikasi Manajemen Fitness

// Mulai session, diperlukan untuk mengakses dan menghapus variabel session
session_start();
 
// Hapus semua variabel session
$_SESSION = array();
 
// Hancurkan session
session_destroy();
 
// Redirect ke halaman login
header("location: login.php");
exit;
?>
