<?php
// login.php: Halaman untuk proses login admin

// Sertakan file konfigurasi database, yang juga sudah memulai session
require_once "config.php";

// Jika user sudah login, arahkan ke halaman utama
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    header('location: index.php');
    exit;
}

$username = $password = "";
$username_err = $password_err = $login_err = "";

// Proses data form saat form disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Validasi input
    if (empty(trim($_POST["username"]))) {
        $username_err = "Silakan masukkan username.";
    } else {
        $username = trim($_POST["username"]);
    }

    if (empty(trim($_POST["password"]))) {
        $password_err = "Silakan masukkan password Anda.";
    } else {
        $password = trim($_POST["password"]);
    }

    // Jika tidak ada error validasi
    if (empty($username_err) && empty($password_err)) {
        $sql = "SELECT id_user, username, password, nama_lengkap FROM user_admin WHERE username = ?";

        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("s", $param_username);
            $param_username = $username;

            if ($stmt->execute()) {
                $stmt->store_result();

                if ($stmt->num_rows == 1) {
                    $stmt->bind_result($id, $username_db, $hashed_password, $nama_lengkap);
                    if ($stmt->fetch()) {
                        // Verifikasi password
                        if (password_verify($password, $hashed_password)) {
                            // Password benar, mulai session baru
                            // (session sudah dimulai dari config.php)

                            // Simpan data di variabel session
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id_user"] = $id;
                            $_SESSION["username"] = $username_db;
                            $_SESSION["nama_lengkap"] = $nama_lengkap;

                            // Redirect ke halaman utama
                            header("location: index.php");
                            exit;
                        } else {
                            $login_err = "Username atau password salah.";
                        }
                    }
                } else {
                    $login_err = "Username atau password salah.";
                }
            } else {
                $login_err = "Oops! Terjadi kesalahan. Silakan coba lagi nanti.";
            }
            $stmt->close();
        }
    }
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login Admin</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #f4f7f9; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; }
        .wrapper { width: 380px; padding: 40px; background: #fff; border-radius: 8px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); text-align: center; }
        .wrapper h2 { margin-bottom: 10px; color: #2c3e50; }
        .wrapper p { margin-bottom: 25px; color: #6c757d; }
        .form-group { margin-bottom: 20px; text-align: left; }
        .form-group label { display: block; margin-bottom: 8px; font-weight: 600; }
        .form-control { width: 100%; padding: 12px; border: 1px solid #ced4da; border-radius: 8px; box-sizing: border-box; }
        .btn-primary { width: 100%; padding: 12px; background-color: #007bff; color: white; border: none; border-radius: 8px; cursor: pointer; font-size: 16px; font-weight: 600; }
        .btn-primary:hover { background-color: #0056b3; }
        .alert-danger { color: #721c24; background-color: #f8d7da; border: 1px solid #f5c6cb; padding: 12px; border-radius: 8px; margin-bottom: 20px; }
        .invalid-feedback { color: #e74c3c; font-size: 0.875em; padding-top: 4px; }
    </style>
</head>
<body>
    <div class="wrapper">
        <h2>Selamat Datang</h2>
        <p>Silakan login untuk mengakses dashboard.</p>
        <?php 
        if(!empty($login_err)){
            echo '<div class="alert alert-danger">' . $login_err . '</div>';
        }        
        ?>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
                <span class="invalid-feedback"><?php echo $username_err; ?></span>
            </div>    
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control">
                <span class="invalid-feedback"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Login">
            </div>
        </form>
    </div>
</body>
</html>
