<?php

// Sertakan file config untuk koneksi database.
include 'config.php';

// Cek jika ada aksi POST untuk menambah member baru
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_member'])) {
    $nama = $_POST['nama'];
    $no_telepon = $_POST['no_telepon'];
    $alamat = $_POST['alamat'];
    $tanggal_daftar = $_POST['tanggal_daftar'];
    
    // Tentukan tanggal kadaluarsa default, misalnya 1 bulan dari tanggal daftar
    $tanggal_kadaluarsa = date('Y-m-d', strtotime($tanggal_daftar . " +1 month"));

    $stmt = $conn->prepare("INSERT INTO member (nama, no_telepon, alamat, tanggal_daftar, tanggal_kadaluarsa, status) VALUES (?, ?, ?, ?, ?, 'Aktif')");
    $stmt->bind_param("sssss", $nama, $no_telepon, $alamat, $tanggal_daftar, $tanggal_kadaluarsa);
    
    if($stmt->execute()){
        header("Location: members.php?status=sukses");
    } else {
        header("Location: members.php?status=gagal");
    }
    $stmt->close();
    exit();
}

// Cek jika ada aksi GET untuk menghapus member (DIPERBAIKI)
if (isset($_GET['delete'])) {
    $id_member = $_GET['delete'];

    // Mulai transaksi untuk memastikan integritas data
    $conn->begin_transaction();

    try {
        // 1. Hapus dulu semua transaksi yang terkait dengan member ini
        $stmt_trans = $conn->prepare("DELETE FROM transaksi WHERE id_member = ?");
        $stmt_trans->bind_param("i", $id_member);
        $stmt_trans->execute();
        $stmt_trans->close();

        // 2. Setelah transaksi dihapus, baru hapus membernya
        $stmt_member = $conn->prepare("DELETE FROM member WHERE id_member = ?");
        $stmt_member->bind_param("i", $id_member);
        $stmt_member->execute();
        $stmt_member->close();

        // Jika semua berhasil, commit transaksi
        $conn->commit();
        header("Location: members.php?status=hapus_sukses");

    } catch (mysqli_sql_exception $exception) {
        // Jika ada error, batalkan semua perubahan
        $conn->rollback();
        header("Location: members.php?status=hapus_gagal&error=" . urlencode($exception->getMessage()));
    }
    exit();
}

include 'header.php';
?>

<h2>Manajemen Member</h2>

<?php
// Tampilkan notifikasi
if(isset($_GET['status'])){
    if($_GET['status'] == 'sukses'){
        echo '<div style="padding: 15px; background-color: #d4edda; color: #155724; border-radius: 5px; margin-bottom: 20px;">Member baru berhasil ditambahkan.</div>';
    } elseif($_GET['status'] == 'hapus_sukses'){
        echo '<div style="padding: 15px; background-color: #d4edda; color: #155724; border-radius: 5px; margin-bottom: 20px;">Member berhasil dihapus.</div>';
    } elseif($_GET['status'] == 'hapus_gagal'){
        $error = isset($_GET['error']) ? htmlspecialchars($_GET['error']) : 'Terjadi kesalahan.';
        echo '<div style="padding: 15px; background-color: #f8d7da; color: #721c24; border-radius: 5px; margin-bottom: 20px;">Gagal menghapus member. Error: ' . $error . '</div>';
    }
}
?>

<!-- Form untuk menambah member baru -->
<form action="members.php" method="POST">
    <h3>Tambah Member Baru</h3>
    <div class="form-group">
        <label for="nama">Nama Lengkap</label>
        <input type="text" id="nama" name="nama" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="no_telepon">No. Telepon</label>
        <input type="text" id="no_telepon" name="no_telepon" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="alamat">Alamat</label>
        <textarea id="alamat" name="alamat" class="form-control" rows="3"></textarea>
    </div>
    <div class="form-group">
        <label for="tanggal_daftar">Tanggal Daftar</label>
        <input type="date" id="tanggal_daftar" name="tanggal_daftar" class="form-control" value="<?php echo date('Y-m-d'); ?>" required>
    </div>
    <button type="submit" name="add_member" class="btn btn-primary">Simpan Member</button>
</form>

<!-- Tabel untuk menampilkan daftar member yang ada -->
<h3 style="margin-top: 40px;">Daftar Member</h3>
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Nama</th>
            <th>No. Telepon</th>
            <th>Alamat</th>
            <th>Tgl Daftar</th>
            <th>Tgl Kadaluarsa</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $sql = "SELECT id_member, nama, no_telepon, alamat, tanggal_daftar, tanggal_kadaluarsa, status FROM member ORDER BY id_member DESC";
        $result = $conn->query($sql);

        if ($result && $result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["id_member"] . "</td>";
                echo "<td>" . htmlspecialchars($row["nama"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["no_telepon"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["alamat"]) . "</td>";
                echo "<td>" . date("d M Y", strtotime($row["tanggal_daftar"])) . "</td>";
                echo "<td>" . date("d M Y", strtotime($row["tanggal_kadaluarsa"])) . "</td>";
                echo "<td>" . $row["status"] . "</td>";
                echo "<td>";
                echo "<a href='members.php?delete=" . $row["id_member"] . "' class='btn btn-danger' onclick='return confirm(\"Apakah Anda yakin ingin menghapus member ini? Ini juga akan menghapus semua riwayat transaksinya.\")'>Hapus</a>";
                echo "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='8' style='text-align:center;'>Belum ada data member.</td></tr>";
        }
        ?>
    </tbody>
</table>

<?php
include 'footer.php';
$conn->close();
?>
