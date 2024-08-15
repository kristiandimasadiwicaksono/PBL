<?php
// Mulai sesi atau ambil sesi yang sudah ada
session_start();

// Hapus semua variabel sesi
$_SESSION = array();

// Jika menggunakan cookie sesi, hapus cookie sesi juga
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Hancurkan sesi
session_destroy();

// Redirect ke halaman login atau halaman utama
header("Location: ../interface/index.html");
exit();
?>
