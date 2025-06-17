<?php
// MUHAMAD SALWARUD 221011401371
// 06TPLP027
// Aplikasi Manajemen Fitness

require_once 'config.php';
require_once 'auth_check.php';

// Cek jika ada aksi POST untuk menambah paket baru
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_package'])) {
    $nama_paket = $_POST['nama_paket'];
    $harga = $_POST['harga'];
    $durasi_bulan = $_POST['durasi_bulan'];

    // Gunakan prepared statement untuk keamanan
    $stmt = $conn->prepare("INSERT INTO paket (nama_paket, harga, durasi_bulan) VALUES (?, ?, ?)");
    $stmt->bind_param("sdi", $nama_paket, $harga, $durasi_bulan);
    
    // Eksekusi query dan redirect dengan status yang sesuai
    if ($stmt->execute()) {
        header("Location: packages.php?status=sukses");
    } else {
        header("Location: packages.php?status=gagal&error=" . urlencode($stmt->error));
    }
    $stmt->close();
    exit();
}

// Cek jika ada aksi GET untuk menghapus paket
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $stmt = $conn->prepare("DELETE FROM paket WHERE id_paket = ?");
    $stmt->bind_param("i", $id);
    
    if($stmt->execute()){
        header("Location: packages.php?status=hapus_sukses");
    } else {
        header("Location: packages.php?status=hapus_gagal");
    }
    $stmt->close();
    exit();
}

// Panggil header setelah semua logika PHP selesai
require_once 'header.php';
?>

<h2>Manajemen Paket</h2>

<?php
// Tampilkan notifikasi berdasarkan parameter URL
if (isset($_GET['status'])) {
    if ($_GET['status'] == 'sukses') {
        echo '<div style="padding: 15px; background-color: #d4edda; color: #155724; border-radius: 5px; margin-bottom: 20px;">Paket baru berhasil ditambahkan.</div>';
    } elseif ($_GET['status'] == 'hapus_sukses') {
        echo '<div style="padding: 15px; background-color: #d4edda; color: #155724; border-radius: 5px; margin-bottom: 20px;">Paket berhasil dihapus.</div>';
    } elseif ($_GET['status'] == 'gagal') {
        $error_message = isset($_GET['error']) ? htmlspecialchars($_GET['error']) : 'Terjadi kesalahan yang tidak diketahui.';
        echo '<div style="padding: 15px; background-color: #f8d7da; color: #721c24; border-radius: 5px; margin-bottom: 20px;">Gagal menyimpan data. Error: ' . $error_message . '</div>';
    } elseif ($_GET['status'] == 'hapus_gagal') {
        echo '<div style="padding: 15px; background-color: #f8d7da; color: #721c24; border-radius: 5px; margin-bottom: 20px;">Gagal menghapus paket.</div>';
    }
}
?>

<form action="packages.php" method="POST">
    <h3>Tambah Paket Baru</h3>
    <div class="form-group">
        <label for="nama_paket">Nama Paket (Contoh: P001, P002)</label>
        <input type="text" id="nama_paket" name="nama_paket" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="harga">Harga (Rp)</label>
        <input type="number" id="harga" name="harga" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="durasi_bulan">Durasi (dalam bulan)</label>
        <input type="number" id="durasi_bulan" name="durasi_bulan" class="form-control" required>
    </div>
    <button type="submit" name="add_package" class="btn btn-primary">Simpan Paket</button>
</form>

<h3 style="margin-top: 40px;">Daftar Paket</h3>
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Nama Paket</th>
            <th>Harga</th>
            <th>Durasi</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $sql = "SELECT * FROM paket ORDER BY id_paket DESC";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["id_paket"] . "</td>";
                echo "<td>" . htmlspecialchars($row["nama_paket"]) . "</td>";
                echo "<td>" . format_rupiah($row["harga"]) . "</td>";
                echo "<td>" . $row["durasi_bulan"] . " bulan</td>";
                echo "<td><a href='packages.php?delete=" . $row["id_paket"] . "' class='btn btn-danger' onclick='return confirm(\"Yakin ingin hapus paket ini?\")'>Hapus</a></td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='5' style='text-align:center;'>Belum ada data paket.</td></tr>";
        }
        ?>
    </tbody>
</table>

<?php
require_once 'footer.php';
$conn->close();
?>
