<?php
/*
================================================================
| FILE: header.php (Diperbaiki)                                |
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
    <!-- Menambahkan Google Font 'Inter' -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- CSS yang ditulis ulang agar lebih modern -->
    <style>
        :root {
            --primary-color: #007bff;
            --secondary-color: #6c757d;
            --dark-color: #2c3e50;
            --light-color: #ecf0f1;
            --background-color: #f4f7f9;
            --white-color: #ffffff;
            --danger-color: #e74c3c;
            --success-color: #2ecc71;
            --border-radius: 8px;
            --shadow: 0 4px 15px rgba(0, 0, 0, 0.07);
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--background-color);
            color: var(--dark-color);
            line-height: 1.6;
        }

        .navbar {
            background-color: var(--dark-color);
            padding: 1rem 2rem;
            color: var(--white-color);
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: var(--shadow);
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .navbar .logo {
            font-size: 1.6rem;
            font-weight: 700;
            color: var(--white-color);
            text-decoration: none;
        }

        .navbar .nav-links {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .navbar .nav-links a {
            color: var(--light-color);
            text-decoration: none;
            font-weight: 500;
            padding: 0.5rem 1rem;
            border-radius: var(--border-radius);
            transition: background-color 0.3s, color 0.3s;
            position: relative;
        }

        .navbar .nav-links a:not(.logout-btn)::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: 0;
            left: 50%;
            background-color: var(--primary-color);
            transition: width 0.3s, left 0.3s;
        }
        
        .navbar .nav-links a:not(.logout-btn):hover::after {
            width: 100%;
            left: 0;
        }

        .navbar .nav-links a:hover {
            color: var(--white-color);
        }

        .navbar .user-info {
            margin-right: 1rem;
            padding-right: 2rem;
            border-right: 1px solid #4a627a;
        }

        .navbar .logout-btn {
            background-color: var(--danger-color);
            color: var(--white-color);
        }

        .navbar .logout-btn:hover {
            background-color: #c0392b;
            color: var(--white-color);
        }

        .container {
            max-width: 1200px;
            margin: 2.5rem auto;
            padding: 2.5rem;
            background: var(--white-color);
            border-radius: var(--border-radius);
            box-shadow: var(--shadow);
        }
        h1, h2, h3 {
            color: var(--dark-color);
            border-bottom: 2px solid var(--light-color);
            padding-bottom: 10px;
            margin-top: 0;
            margin-bottom: 1.5rem;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 2rem;
        }

        th, td {
            border: 1px solid #e0e0e0;
            padding: 1rem;
            text-align: left;
            vertical-align: middle;
        }

        th {
            background-color: #f9fafb;
            font-weight: 600;
        }

        tr:nth-child(even) { background-color: #fdfdfd; }
        
        tr:hover { background-color: #f5f5f5; }

        .btn {
            display: inline-block;
            padding: 0.6rem 1.2rem;
            font-size: 0.95rem;
            font-weight: 600;
            text-align: center;
            text-decoration: none;
            border-radius: var(--border-radius);
            cursor: pointer;
            border: none;
            transition: all 0.3s;
        }

        .btn-primary { background-color: var(--primary-color); color: white; }
        .btn-primary:hover { background-color: #0056b3; transform: translateY(-2px); box-shadow: 0 4px 10px rgba(0, 123, 255, 0.3); }
        .btn-danger { background-color: var(--danger-color); color: white; }
        .btn-danger:hover { background-color: #c0392b; transform: translateY(-2px); box-shadow: 0 4px 10px rgba(231, 76, 60, 0.3); }
        
        form { margin-top: 2rem; padding: 2rem; background-color: #f9fafb; border-radius: var(--border-radius); border: 1px solid #e0e0e0; }
        .form-group { margin-bottom: 1.5rem; }
        .form-group label { display: block; margin-bottom: .5rem; font-weight: 600; }
        .form-control {
            display: block;
            width: 100%;
            padding: 0.75rem;
            font-size: 1rem;
            border: 1px solid #ced4da;
            border-radius: var(--border-radius);
            transition: border-color 0.2s, box-shadow 0.2s;
        }
        .form-control:focus {
            border-color: var(--primary-color);
            outline: none;
            box-shadow: 0 0 0 3px rgba(0, 123, 255, 0.15);
        }

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
            <!-- Diberi pengecekan untuk menghindari warning -->
            Halo, <b><?php echo isset($_SESSION["nama_lengkap"]) ? htmlspecialchars($_SESSION["nama_lengkap"]) : 'Admin'; ?></b>
        </div>
        <a href="logout.php" class="logout-btn">Logout</a>
    </nav>
</header>

<main class="container">
