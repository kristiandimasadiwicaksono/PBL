<?php
    include('../koneksi.php');

    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        $id_mhs = $_POST['id_mhs'];
        $nama_mhs = $_POST['nama_mhs'];
        $npm = $_POST['npm'];
        $alamat = $_POST['alamat'];
        $nama_prodi = $_POST['nama_prodi'];
        $nama_kelas = $_POST['nama_kelas'];
        $thn_akademik = $_POST['thn_akademik'];

        $queryMhs = "UPDATE mahasiswa SET nama_mhs = '$nama_mhs', npm = '$npm', alamat = '$alamat' WHERE id_mhs = '$id_mhs'";
        if(!mysqli_query($connection, $queryMhs)){
            echo "Error: ".$queryMhs."<br>" . mysqli_error($connection);
            exit();
        }
        $queryKls = "UPDATE kelas SET nama_kelas = '$nama_kelas', thn_akademik = '$thn_akademik' WHERE id_mhs = '$id_mhs'";
        if(!mysqli_query($connection, $queryKls)){
            echo "Error: ".$queryKls."<br>". mysqli_error($connection);
            exit();
        }
        $queryProdi = "UPDATE prodi SET nama_prodi = '$nama_prodi' WHERE id_kls = (SELECT id_kls FROM kelas WHERE id_mhs = '$id_mhs')";
        if(!mysqli_query($connection, $queryProdi)){
            echo "Error: ".$queryProdi."<br>". mysqli_error($connection);
            exit();
        }
        header("Location: ../interface/headerList.php");
        exit();

        mysqli_close($connection);
    }else{
        header("Location: ../interface/headerList.php");
        exit();
    }
?>