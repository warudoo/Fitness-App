<?php

include 'config.php';

$error_message = '';
$success_message = '';

// Cek jika ada aksi POST untuk menambah member baru
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_member'])) {
    
    // Ambil data dari form
    $nama = $_POST['nama'];
    $no_telepon = $_POST['no_telepon'];
    $alamat = $_POST['alamat'];
    $tanggal_daftar = $_POST['tanggal_daftar'];
    $id_paket = $_POST['id_paket']; // DIUBAH: Ambil id_paket dari form

    // Pastikan paket dipilih
    if (empty($id_paket)) {
        $error_message = "Silakan pilih paket pendaftaran.";
    } else {
        // Mulai transaksi database untuk memastikan kedua query (insert member & transaksi) berhasil
        $conn->begin_transaction();
        
        try {
            // 1. Ambil detail paket untuk menentukan harga dan durasi
            $stmt_paket = $conn->prepare("SELECT harga, durasi_bulan FROM paket WHERE id_paket = ?");
            $stmt_paket->bind_param("i", $id_paket);
            $stmt_paket->execute();
            $result_paket = $stmt_paket->get_result();
            $paket = $result_paket->fetch_assoc();
            $jumlah_bayar = $paket['harga'];
            $durasi_bulan = $paket['durasi_bulan'];
            $stmt_paket->close();

            // 2. Hitung tanggal kadaluarsa berdasarkan durasi paket
            $tanggal_kadaluarsa = date('Y-m-d', strtotime($tanggal_daftar . " +{$durasi_bulan} month"));

            // 3. Simpan data member baru
            $stmt_member = $conn->prepare("INSERT INTO member (nama, no_telepon, alamat, tanggal_daftar, tanggal_kadaluarsa, status) VALUES (?, ?, ?, ?, ?, 'Aktif')");
            $stmt_member->bind_param("sssss", $nama, $no_telepon, $alamat, $tanggal_daftar, $tanggal_kadaluarsa);
            $stmt_member->execute();
            
            // Ambil ID dari member yang baru saja dimasukkan
            $id_member_baru = $conn->insert_id;
            $stmt_member->close();

            // 4. Buat catatan transaksi untuk pendaftaran ini
            $jenis_transaksi = 'Daftar Baru';
            $tanggal_transaksi = $tanggal_daftar;
            $stmt_trans = $conn->prepare("INSERT INTO transaksi (id_member, id_paket, tanggal_transaksi, jenis_transaksi, total_bayar) VALUES (?, ?, ?, ?, ?)");
            $stmt_trans->bind_param("iisss", $id_member_baru, $id_paket, $tanggal_transaksi, $jenis_transaksi, $jumlah_bayar);
            $stmt_trans->execute();
            $stmt_trans->close();

            // Jika semua query berhasil, commit transaksi
            $conn->commit();
            $success_message = "Member baru berhasil ditambahkan beserta transaksinya.";

        } catch (mysqli_sql_exception $exception) {
            // Jika ada error, batalkan semua perubahan (rollback)
            $conn->rollback();
            $error_message = "Gagal menyimpan data. Error: " . $exception->getMessage();
        }
    }
}

// Cek jika ada aksi GET untuk menghapus member
if (isset($_GET['delete'])) {
    $id_member = $_GET['delete'];
    
    $stmt = $conn->prepare("DELETE FROM member WHERE id_member = ?");
    $stmt->bind_param("i", $id_member);
    
    if($stmt->execute()){
        $success_message = "Member berhasil dihapus.";
    } else {
        $error_message = "Gagal menghapus member.";
    }
    $stmt->close();
}

include 'header.php';
?>

<h2>Manajemen Member</h2>

<?php
// Tampilkan notifikasi jika ada
if (!empty($success_message)) {
    echo '<div style="padding: 15px; background-color: #d4edda; color: #155724; border-radius: 5px; margin-bottom: 20px;">' . $success_message . '</div>';
}
if (!empty($error_message)) {
    echo '<div style="padding: 15px; background-color: #f8d7da; color: #721c24; border-radius: 5px; margin-bottom: 20px;">' . $error_message . '</div>';
}
?>

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
    <div class="form-group">
        <label for="id_paket">Paket Pendaftaran</label>
        <select id="id_paket" name="id_paket" class="form-control" required>
            <option value="">-- Pilih Paket --</option>
            <?php
            $paket_result = $conn->query("SELECT id_paket, nama_paket, harga, durasi_bulan FROM paket");
            while ($paket = $paket_result->fetch_assoc()) {
                echo "<option value='{$paket['id_paket']}'>" . htmlspecialchars($paket['nama_paket']) . " (" . $paket['durasi_bulan'] . " bulan) - " . format_rupiah($paket['harga']) . "</option>";
            }
            ?>
        </select>
    </div>
    <button type="submit" name="add_member" class="btn btn-primary">Simpan Member</button>
</form>


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
                echo "<a href='members.php?delete=" . $row["id_member"] . "' class='btn btn-danger' onclick='return confirm(\"Apakah Anda yakin ingin menghapus member ini?\")'>Hapus</a>";
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
