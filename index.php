<?php

// Sertakan file config dan header
include 'config.php';
include 'header.php';

// Query untuk menghitung total member
$stmt_members = $conn->prepare("SELECT COUNT(id_member) as total_member FROM member");
$stmt_members->execute();
$result_members = $stmt_members->get_result();
$total_members = $result_members->fetch_assoc()['total_member'] ?? 0;
$stmt_members->close();

// Query untuk menghitung total pendapatan
$stmt_income = $conn->prepare("SELECT SUM(total_bayar) as total_pendapatan FROM transaksi");
$stmt_income->execute();
$result_income = $stmt_income->get_result();
$total_income = $result_income->fetch_assoc()['total_pendapatan'] ?? 0;
$stmt_income->close();

?>
<h1>Dashboard</h1>
<p>Selamat datang di sistem manajemen fitness. Berikut ringkasan data saat ini:</p>

<div style="display: flex; gap: 20px;">
    <div style="flex: 1; padding: 20px; background-color: #e3f2fd; border-radius: 8px; text-align: center;">
        <h3>Total Member</h3>
        <p style="font-size: 2rem; font-weight: bold;"><?php echo $total_members; ?></p>
    </div>
    <div style="flex: 1; padding: 20px; background-color: #e8f5e9; border-radius: 8px; text-align: center;">
        <h3>Total Pendapatan</h3>
        <p style="font-size: 2rem; font-weight: bold;"><?php echo format_rupiah($total_income); ?></p>
    </div>
</div>

<?php
// Sertakan file footer
include 'footer.php';
$conn->close();
?>
