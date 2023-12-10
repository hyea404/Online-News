<?php
// Import file konfigurasi dan fungsi database
include 'config.php';
include 'db.php';

// Mulai sesi (pastikan ini dijalankan di setiap halaman yang membutuhkan sesi)
session_start();

// Periksa apakah pengguna sudah login dan memiliki peran admin
if (!isset($_SESSION["user_id"]) || $_SESSION["role"] !== ROLE_ADMIN) {
    // Jika tidak, redirect ke halaman login
    header("Location: login.php");
    exit();
}

// Fungsi untuk mendapatkan daftar user
function getAllUsers() {
    global $conn;

    $result = $conn->query("SELECT id, username, role FROM users");
    return $result->fetch_all(MYSQLI_ASSOC);
}

// Fungsi untuk mendapatkan daftar news
function getAllNews() {
    global $conn;

    $result = $conn->query("SELECT id, title, updated_at FROM news ORDER BY updated_at DESC");
    return $result->fetch_all(MYSQLI_ASSOC);
}

// Ambil daftar user
$users = getAllUsers();

// Ambil daftar news
$news = getAllNews();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page - Hyea</title>
    <link rel="stylesheet" href="css/style.css">
    <!-- Sesuaikan path di atas dengan struktur direktori Anda -->
</head>
<body>
    <h2>Admin Page</h2>

    <h3>Daftar User</h3>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Role</th>
        </tr>
        <?php foreach ($users as $user) : ?>
            <tr>
                <td><?php echo $user["id"]; ?></td>
                <td><?php echo $user["username"]; ?></td>
                <td><?php echo $user["role"]; ?></td>
            </tr>
        <?php endforeach; ?>
    </table>

    <h3>Daftar News</h3>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Updated At</th>
        </tr>
        <?php foreach ($news as $item) : ?>
            <tr>
                <td><?php echo $item["id"]; ?></td>
                <td><?php echo $item["title"]; ?></td>
                <td><?php echo $item["updated_at"]; ?></td>
            </tr>
        <?php endforeach; ?>
    </table>

    <p><a href="logout.php">Logout</a></p>
</body>
</html>
