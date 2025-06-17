<?php
// auth_check.php: Memeriksa session login

// Jika session 'loggedin' tidak ada atau tidak bernilai true,
// redirect ke halaman login.
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}
?>
