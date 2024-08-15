<?php
include('../koneksi.php');

class Mahasiswa {
    private $db;

    public function __construct($dbConnection) {
        $this->db = $dbConnection;
    }

    public function insert($nama, $npm, $alamat) {
        $stmt = $this->db->prepare("INSERT INTO mahasiswa (nama_mhs, npm, alamat) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $nama, $npm, $alamat);
        if ($stmt->execute()) {
            $last_id = $stmt->insert_id; // Get the last inserted id_mhs
            $stmt->close();
            return $last_id;
        } else {
            $stmt->close();
            return "Data mahasiswa gagal disimpan: " . $stmt->error;
        }
    }
}

class Kelas {
    private $db;

    public function __construct($dbConnection) {
        $this->db = $dbConnection;
    }

    public function insert($nama_kelas, $thn_akademik, $id_mhs) {
        $stmt = $this->db->prepare("INSERT INTO kelas (nama_kelas, thn_akademik, id_mhs) VALUES (?, ?, ?)");
        $stmt->bind_param("sii", $nama_kelas, $thn_akademik, $id_mhs);
        if ($stmt->execute()) {
            $last_id = $stmt->insert_id; // Get the last inserted id_kls
            $stmt->close();
            return $last_id;
        } else {
            $stmt->close();
            return "Data kelas gagal disimpan: " . $stmt->error;
        }
    }
}

class Prodi {
    private $db;

    public function __construct($dbConnection) {
        $this->db = $dbConnection;
    }

    public function insert($nama_prodi, $id_kls) {
        $stmt = $this->db->prepare("INSERT INTO prodi (nama_prodi, id_kls) VALUES (?, ?)");
        $stmt->bind_param("si", $nama_prodi, $id_kls);
        if ($stmt->execute()) {
            $stmt->close();
            return true;
        } else {
            $stmt->close();
            return "Data prodi gagal disimpan: " . $stmt->error;
        }
    }
}

// Collect POST data
$nama = $_POST['nama_mhs'];
$npm = $_POST['npm'];
$alamat = $_POST['alamat'];
$nama_kelas = $_POST['nama_kelas'];
$thn_akademik = $_POST['thn_akademik'];
$nama_prodi = $_POST['nama_prodi'];

// Initialize Database and Mahasiswa
$db = new Database();
$connection = $db->getConnection();
$mahasiswa = new Mahasiswa($connection);
$kelas = new Kelas($connection);
$prodi = new Prodi($connection);

// Insert data into mahasiswa table first
$id_mhs = $mahasiswa->insert($nama, $npm, $alamat);
if (is_numeric($id_mhs)) {
    // Insert data into kelas table with the retrieved id_mhs
    $id_kls = $kelas->insert($nama_kelas, $thn_akademik, $id_mhs);
    if (is_numeric($id_kls)) {
        // Insert data into prodi table with the retrieved id_kls
        $resultProdi = $prodi->insert($nama_prodi, $id_kls);
        if ($resultProdi === true) {
            header("Location: ../interface/headerList.php");
            exit();
        } else {
            $message = urlencode($resultProdi);
            header("Location: ../interface/headerList.php?message=" . $message);
            exit();
        }
    } else {
        $message = urlencode($id_kls);
        header("Location: ../interface/headerList.php?message=" . $message);
        exit();
    }
} else {
    $message = urlencode($id_mhs);
    header("Location: ../interface/headerList.php?message=" . $message);
    exit();
}
?>