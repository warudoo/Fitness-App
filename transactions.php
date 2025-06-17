<?php
include 'config.php';
include 'auth_check.php'; 


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_transaction'])) {
    $id_member = $_POST['id_member'];
    $id_paket = $_POST['id_paket'];
    $jenis_transaksi = $_POST['jenis_transaksi'];
    $tanggal_transaksi = date("Y-m-d");

    $stmt_paket = $conn->prepare("SELECT harga, durasi_bulan FROM paket WHERE id_paket = ?");
    $stmt_paket->bind_param("i", $id_paket);
    $stmt_paket->execute();
    $result_paket = $stmt_paket->get_result();
    $paket = $result_paket->fetch_assoc();
    $jumlah_bayar = $paket['harga'];
    $durasi_bulan = $paket['durasi_bulan'];
    $stmt_paket->close();

    $stmt_trans = $conn->prepare("INSERT INTO transaksi (id_member, id_paket, tanggal_transaksi, jenis_transaksi, total_bayar) VALUES (?, ?, ?, ?, ?)");
    $stmt_trans->bind_param("iisss", $id_member, $id_paket, $tanggal_transaksi, $jenis_transaksi, $jumlah_bayar);
    $stmt_trans->execute();
    $stmt_trans->close();

    $stmt_member_expiry = $conn->prepare("UPDATE member SET tanggal_kadaluarsa = DATE_ADD(tanggal_kadaluarsa, INTERVAL ? MONTH) WHERE id_member = ?");
    $stmt_member_expiry->bind_param("ii", $durasi_bulan, $id_member);
    $stmt_member_expiry->execute();
    $stmt_member_expiry->close();

    header("Location: transactions.php");
    exit();
}

include 'header.php';
?>

<h2>Manajemen Transaksi</h2>

<form action="transactions.php" method="POST">
    <h3>Tambah Transaksi Baru</h3>
    <div class="form-group">
        <label for="id_member">Pilih Member</label>
        <select id="id_member" name="id_member" class="form-control" required>
            <option value="">-- Pilih Member --</option>
            <?php
            $member_result = $conn->query("SELECT id_member, nama FROM member ORDER BY nama ASC");
            while ($member = $member_result->fetch_assoc()) {
                echo "<option value='{$member['id_member']}'>" . htmlspecialchars($member['nama']) . "</option>";
            }
            ?>
        </select>
    </div>
    <div class="form-group">
        <label for="id_paket">Pilih Paket</label>
        <select id="id_paket" name="id_paket" class="form-control" required>
            <option value="">-- Pilih Paket --</option>
            <?php
            $paket_result = $conn->query("SELECT id_paket, nama_paket, harga FROM paket");
            while ($paket = $paket_result->fetch_assoc()) {
                echo "<option value='{$paket['id_paket']}'>" . htmlspecialchars($paket['nama_paket']) . " (" . format_rupiah($paket['harga']) . ")</option>";
            }
            ?>
        </select>
    </div>
    <div class="form-group">
        <label for="jenis_transaksi">Jenis Transaksi</label>
        <select id="jenis_transaksi" name="jenis_transaksi" class="form-control" required>
            <option value="Daftar Baru">Daftar Baru</option>
            <option value="Perpanjangan">Perpanjangan</option>
        </select>
    </div>
    <button type="submit" name="add_transaction" class="btn btn-primary">Simpan Transaksi</button>
</form>

<h3 style="margin-top: 40px;">Riwayat Transaksi</h3>
<table>
    <thead>
        <tr>
            <th>ID Transaksi</th>
            <th>Nama Member</th>
            <th>Paket Dibeli</th>
            <th>Jenis</th>
            <th>Jumlah Bayar</th>
            <th>Tanggal</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $sql = "SELECT t.id_transaksi, m.nama, p.nama_paket, t.jenis_transaksi, t.total_bayar, t.tanggal_transaksi 
                FROM transaksi t
                JOIN member m ON t.id_member = m.id_member
                JOIN paket p ON t.id_paket = p.id_paket
                ORDER BY t.id_transaksi DESC";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["id_transaksi"] . "</td>";
                echo "<td>" . htmlspecialchars($row["nama"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["nama_paket"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["jenis_transaksi"]) . "</td>";
                echo "<td>" . format_rupiah($row["total_bayar"]) . "</td>";
                echo "<td>" . date("d M Y", strtotime($row["tanggal_transaksi"])) . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='6' style='text-align:center;'>Belum ada data transaksi.</td></tr>";
        }
        ?>
    </tbody>
</table>

<?php
include 'footer.php';
$conn->close();
?>
