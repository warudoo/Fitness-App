<?php

?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplikasi Manajemen Fitness</title>
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
            background-color: #f8f9fa;
            color: #343a40;
            margin: 0;
            line-height: 1.6;
        }
        .navbar {
            background-color: #343a40;
            padding: 1rem;
            color: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .navbar .logo {
            font-size: 1.5rem;
            font-weight: bold;
            color: white;
            text-decoration: none;
        }
        .navbar .nav-links a {
            color: #f8f9fa;
            text-decoration: none;
            margin: 0 15px;
            font-size: 1rem;
            padding: 8px 12px;
            border-radius: 5px;
            transition: background-color 0.3s;
        }
        .navbar .nav-links a:hover, .navbar .nav-links a.active {
            background-color: #495057;
        }
        .container {
            max-width: 1100px;
            margin: 2rem auto;
            padding: 2rem;
            background: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
        }
        h1, h2, h3 {
            color: #212529;
            border-bottom: 2px solid #dee2e6;
            padding-bottom: 10px;
            margin-top: 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #dee2e6;
            padding: 12px;
            text-align: left;
            vertical-align: middle;
        }
        th {
            background-color: #f1f3f5;
            font-weight: 600;
        }
        tr:nth-child(even) { background-color: #f8f9fa; }
        .btn {
            display: inline-block;
            padding: 8px 15px;
            font-size: 0.9rem;
            font-weight: 500;
            text-align: center;
            text-decoration: none;
            border-radius: 5px;
            cursor: pointer;
            border: 1px solid transparent;
            transition: all 0.3s;
        }
        .btn-primary { background-color: #007bff; color: white; border-color: #007bff; }
        .btn-primary:hover { background-color: #0056b3; }
        .btn-danger { background-color: #dc3545; color: white; border-color: #dc3545; }
        .btn-danger:hover { background-color: #c82333; }
        .btn-edit { background-color: #ffc107; color: #212529; border-color: #ffc107; }
        .btn-edit:hover { background-color: #e0a800; }
        form { margin-top: 20px; padding: 20px; background-color: #f8f9fa; border-radius: 8px; border: 1px solid #dee2e6; }
        .form-group { margin-bottom: 1rem; }
        .form-group label { display: block; margin-bottom: .5rem; font-weight: 500; }
        .form-control {
            display: block;
            width: calc(100% - 24px);
            padding: 10px;
            font-size: 1rem;
            border: 1px solid #ced4da;
            border-radius: 5px;
        }
        .footer {
            text-align: center;
            padding: 1.5rem;
            margin-top: 2rem;
            background-color: #f1f3f5;
            color: #6c757d;
            border-top: 1px solid #dee2e6;
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
    </nav>
</header>

<main class="container">
