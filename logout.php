<?php
// logout.php: Skrip untuk proses logout

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
