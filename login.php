<?php
// login.php: Halaman untuk proses login admin

// Mulai session
session_start();

// Jika sudah login, redirect ke halaman utama
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    header('location: index.php');
    exit;
}

// Sertakan file konfigurasi database
require_once "config.php";

$username = $password = "";
$username_err = $password_err = $login_err = "";

// Proses data form saat form disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Validasi username
    if (empty(trim($_POST["username"]))) {
        $username_err = "Silakan masukkan username.";
    } else {
        $username = trim($_POST["username"]);
    }

    // Validasi password
    if (empty(trim($_POST["password"]))) {
        $password_err = "Silakan masukkan password Anda.";
    } else {
        $password = trim($_POST["password"]);
    }

    // Jika tidak ada error validasi
    if (empty($username_err) && empty($password_err)) {
        // Siapkan statement SELECT
        $sql = "SELECT id_user, username, password, nama_lengkap FROM user_admin WHERE username = ?";

        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("s", $param_username);
            $param_username = $username;

            if ($stmt->execute()) {
                $stmt->store_result();

                // Cek jika username ada, lalu verifikasi password
                if ($stmt->num_rows == 1) {
                    $stmt->bind_result($id, $username, $hashed_password, $nama_lengkap);
                    if ($stmt->fetch()) {
                        if (password_verify($password, $hashed_password)) {
                            // Password benar, mulai session baru
                            session_start();

                            // Simpan data di session
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id_user"] = $id;
                            $_SESSION["username"] = $username;
                            $_SESSION["nama_lengkap"] = $nama_lengkap;

                            // Redirect ke halaman utama
                            header("location: index.php");
                        } else {
                            // Password salah
                            $login_err = "Username atau password salah.";
                        }
                    }
                } else {
                    // Username tidak ditemukan
                    $login_err = "Username atau password salah.";
                }
            } else {
                echo "Oops! Terjadi kesalahan. Silakan coba lagi nanti.";
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
    <style>
        body { font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif; background-color: #f8f9fa; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; }
        .wrapper { width: 360px; padding: 30px; background: #fff; border-radius: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.1); }
        .wrapper h2 { text-align: center; margin-bottom: 20px; color: #343a40; }
        .form-group { margin-bottom: 15px; }
        .form-group label { display: block; margin-bottom: 5px; font-weight: 500; }
        .form-control { width: 100%; padding: 10px; border: 1px solid #ced4da; border-radius: 5px; box-sizing: border-box; }
        .btn-primary { width: 100%; padding: 10px; background-color: #007bff; color: white; border: none; border-radius: 5px; cursor: pointer; font-size: 16px; }
        .btn-primary:hover { background-color: #0056b3; }
        .alert-danger { color: #721c24; background-color: #f8d7da; border: 1px solid #f5c6cb; padding: 10px; border-radius: 5px; margin-bottom: 15px; }
    </style>
</head>
<body>
    <div class="wrapper">
        <h2>Login Admin</h2>
        <p>Silakan isi kredensial Anda untuk masuk.</p>
        <?php 
        if(!empty($login_err)){
            echo '<div class="alert alert-danger">' . $login_err . '</div>';
        }        
        ?>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>">
                <span class="invalid-feedback"><?php echo $username_err; ?></span>
            </div>    
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>">
                <span class="invalid-feedback"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Login">
            </div>
        </form>
    </div>
</body>
</html>
