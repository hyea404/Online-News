<?php
// Import file konfigurasi dan fungsi database
include 'config.php';
include 'db.php';

// Cek apakah form login telah di-submit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil nilai dari form
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Cari user berdasarkan username
    $user = getUserByUsername($username);

    // Jika user ditemukan dan password cocok
    if ($user && password_verify($password, $user["password"])) {
        // Start session dan simpan informasi user di session
        session_start();
        $_SESSION["user_id"] = $user["id"];
        $_SESSION["username"] = $user["username"];
        $_SESSION["role"] = $user["role"];

        // Redirect ke halaman utama setelah login berhasil
        header("Location: index.php");
        exit();
    } else {
        // Jika login gagal, tampilkan pesan error
        $error_message = "Username atau Password salah.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Hyea</title>
    <link rel="stylesheet" href="css/style.css">
    <!-- Sesuaikan path di atas dengan struktur direktori Anda -->
</head>
<body>
    <form method="post" action="login.php">
        <h2>Login</h2>
        
        <?php
        // Tampilkan pesan error jika login gagal
        if (isset($error_message)) {
            echo '<p style="color: red;">' . $error_message . '</p>';
        }
        ?>

        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>

        <button type="submit">Login</button>
    </form>
</body>
</html>
