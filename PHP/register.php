<?php
// Import file konfigurasi dan fungsi database
include 'config.php';
include 'db.php';

// Cek apakah form register telah di-submit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil nilai dari form
    $username = $_POST["username"];
    $password = $_POST["password"];
    $email = $_POST["email"];

    // Validasi input (contoh sederhana, sesuaikan dengan kebutuhan)
    if (empty($username) || empty($password) || empty($email)) {
        $error_message = "Semua kolom harus diisi.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error_message = "Format email tidak valid.";
    } else {
        // Cek apakah username sudah terdaftar
        $existingUser = getUserByUsername($username);

        if ($existingUser) {
            $error_message = "Username sudah terdaftar. Pilih username lain.";
        } else {
            // Tambahkan user baru ke database
            $result = addUser($username, $password, $email);

            if ($result) {
                // Redirect ke halaman login setelah registrasi berhasil
                header("Location: login.php");
                exit();
            } else {
                $error_message = "Terjadi kesalahan saat menambahkan user. Silakan coba lagi.";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Hyea</title>
    <link rel="stylesheet" href="css/style.css">
    <!-- Sesuaikan path di atas dengan struktur direktori Anda -->
</head>
<body>
    <form method="post" action="register.php">
        <h2>Register</h2>
        
        <?php
        // Tampilkan pesan error jika ada
        if (isset($error_message)) {
            echo '<p style="color: red;">' . $error_message . '</p>';
        }
        ?>

        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>

        <button type="submit">Register</button>
    </form>
</body>
</html>
