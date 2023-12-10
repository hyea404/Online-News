<?php
include 'config.php';

// Fungsi untuk menambahkan user
function addUser($username, $password, $email) {
    global $conn;

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO users (username, password, email) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $username, $hashedPassword, $email);

    if ($stmt->execute()) {
        return true;
    } else {
        return false;
    }
}

// Fungsi untuk mengambil data user berdasarkan username
function getUserByUsername($username) {
    global $conn;

    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();

    $result = $stmt->get_result();
    
    return $result->fetch_assoc();
}

// Fungsi untuk mengambil data user berdasarkan ID
function getUserById($userId) {
    global $conn;

    $stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
    $stmt->bind_param("i", $userId);
    $stmt->execute();

    $result = $stmt->get_result();
    
    return $result->fetch_assoc();
}

// Fungsi untuk menambahkan berita (news)
function addNews($title, $content, $userId) {
    global $conn;

    $stmt = $conn->prepare("INSERT INTO news (title, content, user_id) VALUES (?, ?, ?)");
    $stmt->bind_param("ssi", $title, $content, $userId);

    if ($stmt->execute()) {
        return true;
    } else {
        return false;
    }
}

// Fungsi untuk mengambil semua berita
function getAllNews() {
    global $conn;

    $result = $conn->query("SELECT * FROM news ORDER BY created_at DESC");
    return $result->fetch_all(MYSQLI_ASSOC);
}

// Fungsi untuk mengubah berita berdasarkan ID
function updateNews($newsId, $title, $content) {
    global $conn;

    $stmt = $conn->prepare("UPDATE news SET title = ?, content = ?, updated_at = CURRENT_TIMESTAMP WHERE id = ?");
    $stmt->bind_param("ssi", $title, $content, $newsId);

    if ($stmt->execute()) {
        return true;
    } else {
        return false;
    }
}

// Fungsi untuk menghapus berita berdasarkan ID
function deleteNews($newsId) {
    global $conn;

    $stmt = $conn->prepare("DELETE FROM news WHERE id = ?");
    $stmt->bind_param("i", $newsId);

    if ($stmt->execute()) {
        return true;
    } else {
        return false;
    }
}

// Fungsi untuk mengambil role user berdasarkan username
function getUserRole($username) {
    global $conn;

    $stmt = $conn->prepare("SELECT role FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row["role"];
    } else {
        return null;
    }
}
?>
