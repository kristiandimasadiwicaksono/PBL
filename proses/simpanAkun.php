<?php
include('../koneksi.php');

$Username = $_POST['Username'];
$Password = $_POST['Password'];
$nama_lengkap = $_POST['nama_lengkap'];

$query_check = "SELECT * FROM user WHERE Username = ? OR nama_lengkap = ?";
$stmt = $connection->prepare($query_check);
$stmt->bind_param("ss", $Username, $nama_lengkap);
$stmt->execute();
$stmt = $stmt->get_result();

if($stmt->num_rows > 0){
    echo "<script>
            alert('Username atau Nama Lengkap sudah terdaftar!');
            window.location.href = '../interface/index.html#registerPopup';
          </script>";
}else{

$hashedPassword = password_hash($Password, PASSWORD_BCRYPT);

$query = "INSERT INTO user (Username, Password, nama_lengkap) VALUES ('$Username', '$hashedPassword', '$nama_lengkap')";
$stmt_insert = $connection->prepare($query);
$stmt_insert->bind_param("sss", $Username, $hashedPassword, $nama_lengkap);

if($stmt_insert->execute()){
    header("Location: ../interface/header.php");
}else{
    echo "Error: ". $query."<br>". mysqli_error($connection);
}
$stmt_insert->close();
}

$stmt->close();
$connection->close();
?>