<?php
include('../koneksi.php');
session_start();

$username = isset($_POST['Username']) ? $_POST['Username'] : '';
$password = isset($_POST['Password']) ? $_POST['Password'] : '';

$db = new Database();
$connection = $db->getConnection();

$query = "SELECT * FROM user WHERE Username = ?";
$stmt = $connection->prepare($query);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
    // Verifikasi password dengan password_verify
    if (password_verify($password, $user['Password'])) {
        // Password benar, set session dan redirect
        $_SESSION['logged_in'] = true;
        $_SESSION['username'] = $username;
        $_SESSION['nama_lengkap'] = $user['nama_lengkap']; // Simpan nama lengkap di sesi

        header("location:../interface/header.php#home");
        exit();
    } else {
        // Password salah, redirect dengan pesan gagal login
        header("location:../interface/index.html?gagal_login=1");
        exit();
    }
} else {
    // Username tidak ditemukan, redirect dengan pesan gagal login
    header("location:../interface/index.html?gagal_login=1");
    exit();
}

$stmt->close();
$connection->close();
?>
