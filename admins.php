<?php
// MUHAMAD SALWARUD 221011401371
// 06TPLP027
// Aplikasi Manajemen Fitness
// admins.php: Halaman untuk manajemen user admin

include 'config.php';
include 'auth_check.php'; // Pastikan hanya admin yang login bisa akses

// Logika untuk menambah admin baru
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_admin'])) {
    $username = $_POST['username'];
    $nama_lengkap = $_POST['nama_lengkap'];
    $password = $_POST['password'];
    
    // Hash password untuk keamanan
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO user_admin (username, password, nama_lengkap) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $username, $hashed_password, $nama_lengkap);
    
    if ($stmt->execute()) {
        header("Location: admins.php?status=sukses");
    } else {
        header("Location: admins.php?status=gagal");
    }
    $stmt->close();
    exit();
}

// Logika untuk menghapus admin
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    // Pencegahan agar admin tidak menghapus dirinya sendiri
    if ($id == $_SESSION['id_user']) {
        header("Location: admins.php?status=hapus_gagal_sendiri");
        exit();
    }
    
    $stmt = $conn->prepare("DELETE FROM user_admin WHERE id_user = ?");
    $stmt->bind_param("i", $id);
    
    if ($stmt->execute()) {
        header("Location: admins.php?status=hapus_sukses");
    } else {
        header("Location: admins.php?status=hapus_gagal");
    }
    $stmt->close();
    exit();
}


include 'header.php';
?>

<h2>Manajemen Admin</h2>

<?php
// Tampilkan notifikasi
if (isset($_GET['status'])) {
    if ($_GET['status'] == 'sukses') {
        echo '<div style="padding: 15px; background-color: #d4edda; color: #155724; border-radius: 5px; margin-bottom: 20px;">Admin baru berhasil ditambahkan.</div>';
    } elseif ($_GET['status'] == 'hapus_sukses') {
        echo '<div style="padding: 15px; background-color: #d4edda; color: #155724; border-radius: 5px; margin-bottom: 20px;">Admin berhasil dihapus.</div>';
    } elseif ($_GET['status'] == 'hapus_gagal_sendiri') {
        echo '<div style="padding: 15px; background-color: #f8d7da; color: #721c24; border-radius: 5px; margin-bottom: 20px;">Anda tidak dapat menghapus akun Anda sendiri.</div>';
    }
}
?>

<form action="admins.php" method="POST">
    <h3>Tambah Admin Baru</h3>
    <div class="form-group">
        <label for="username">Username</label>
        <input type="text" id="username" name="username" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="nama_lengkap">Nama Lengkap</label>
        <input type="text" id="nama_lengkap" name="nama_lengkap" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" id="password" name="password" class="form-control" required>
    </div>
    <button type="submit" name="add_admin" class="btn btn-primary">Simpan Admin</button>
</form>

<h3 style="margin-top: 40px;">Daftar Admin</h3>
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Nama Lengkap</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $sql = "SELECT id_user, username, nama_lengkap FROM user_admin ORDER BY id_user DESC";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["id_user"] . "</td>";
                echo "<td>" . htmlspecialchars($row["username"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["nama_lengkap"]) . "</td>";
                echo "<td>";
                // Hanya tampilkan tombol hapus jika bukan user yang sedang login
                if ($row["id_user"] != $_SESSION['id_user']) {
                    echo "<a href='admins.php?delete=" . $row["id_user"] . "' class='btn btn-danger' onclick='return confirm(\"Yakin ingin hapus admin ini?\")'>Hapus</a>";
                }
                echo "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='4' style='text-align:center;'>Belum ada data admin.</td></tr>";
        }
        ?>
    </tbody>
</table>

<?php
include 'footer.php';
$conn->close();
?>
