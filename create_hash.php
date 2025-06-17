<?php

// Password sederhana yang akan kita hash.
// Anda bisa mengganti ini jika mau, tapi ingat passwordnya.
$passwordToHash = 'admin123';

// Membuat hash menggunakan algoritma default yang kuat (BCRYPT)
$hashedPassword = password_hash($passwordToHash, PASSWORD_DEFAULT);

?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Generator Hash Password</title>
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #f4f7f9; padding: 40px; }
        .container { max-width: 800px; margin: auto; padding: 30px; background: #fff; border-radius: 8px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); }
        h1 { color: #2c3e50; }
        p { font-size: 1.1rem; line-height: 1.7; }
        .hash-box { 
            background-color: #ecf0f1; 
            border: 2px dashed #bdc3c7;
            padding: 20px;
            font-family: 'Courier New', Courier, monospace;
            font-size: 1.1rem;
            word-wrap: break-word;
            margin-top: 20px;
            border-radius: 8px;
        }
        .warning {
            background-color: #f8d7da;
            color: #721c24;
            padding: 15px;
            border-radius: 8px;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Generator Hash Password</h1>
        <p>Gunakan hash di bawah ini untuk memperbarui password di database Anda. Hash ini dibuat untuk password: <strong><?php echo htmlspecialchars($passwordToHash); ?></strong></p>
        
        <p><strong>Salin (copy) seluruh teks di dalam kotak di bawah ini:</strong></p>
        <div class="hash-box">
            <?php echo htmlspecialchars($hashedPassword); ?>
        </div>

        <div class="warning">
            <strong>Penting:</strong> Setelah Anda menyalin hash ini, hapus file <strong>create_hash.php</strong> ini dari server Anda demi keamanan.
        </div>
    </div>
</body>
</html>
