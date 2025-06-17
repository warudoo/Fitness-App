<?php
/*
================================================================
| FILE: header.php (Diperbarui)                                |
| DESKRIPSI: Bagian atas (header) dari semua halaman.          |
================================================================
*/
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplikasi Manajemen Fitness</title>
    <style>
        /* ... CSS Anda dari sebelumnya ... */
        body { font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif; background-color: #f8f9fa; color: #343a40; margin: 0; line-height: 1.6; }
        .navbar { background-color: #343a40; padding: 1rem; color: white; display: flex; justify-content: space-between; align-items: center; }
        .navbar .logo { font-size: 1.5rem; font-weight: bold; color: white; text-decoration: none; }
        .navbar .nav-links { display: flex; align-items: center; }
        .navbar .nav-links a { color: #f8f9fa; text-decoration: none; margin: 0 15px; font-size: 1rem; padding: 8px 12px; border-radius: 5px; transition: background-color 0.3s; }
        .navbar .nav-links a:hover, .navbar .nav-links a.active { background-color: #495057; }
        .navbar .user-info { margin-right: 20px; }
        .navbar .logout-btn { background-color: #dc3545; color: white; }
        .navbar .logout-btn:hover { background-color: #c82333; }
        .container { max-width: 1100px; margin: 2rem auto; padding: 2rem; background: #ffffff; border-radius: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.08); }
        h1, h2, h3 { color: #212529; border-bottom: 2px solid #dee2e6; padding-bottom: 10px; margin-top: 0; }
        /* ... Sisa CSS ... */
    </style>
</head>
<body>

<header class="navbar">
    <a href="index.php" class="logo">FitnessApp</a>
    <nav class="nav-links">
        <a href="index.php">Dashboard</a>
        <a href="members.php">Member</a>
        <a href="packages.php">Paket</a>
        <a href="transactions.php">Transaksi</a>
        <a href="admins.php">Admin</a>
        <div class="user-info">
            Halo, <b><?php echo htmlspecialchars($_SESSION["nama_lengkap"]); ?></b>
        </div>
        <a href="logout.php" class="logout-btn">Logout</a>
    </nav>
</header>

<main class="container">
