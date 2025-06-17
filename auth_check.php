<?php

// MUHAMAD SALWARUD 221011401371
// 06TPLP027
// Aplikasi Manajemen Fitness

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit; // Pastikan untuk menghentikan eksekusi skrip setelah redirect.
}
?>
