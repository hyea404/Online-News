<?php
// Mendefinisikan variabel untuk koneksi ke database MySQL
$host = "localhost"; // Sesuaikan dengan host MySQL Anda
$username = "root"; // Sesuaikan dengan username MySQL Anda
$password = ""; // Sesuaikan dengan password MySQL Anda
$database = "data_user81"; // Sesuaikan dengan nama database Anda

// Membuat koneksi ke database
$conn = new mysqli($host, $username, $password, $database);

// Check koneksi
if ($conn->connect_error) {
    die("Koneksi ke database gagal: " . $conn->connect_error);
}

// Mendefinisikan konstanta untuk role user dan admin
define("ROLE_USER", "user");
define("ROLE_ADMIN", "admin");
?>
