<?php

class Database {
    private $connection;
    private $host = 'localhost';
    private $user = 'root';
    private $pass = '';
    private $db_name = 'perkuliahan';

    public function __construct() {
        $this->connect();
    }

    private function connect() {
        $this->connection = new mysqli($this->host, $this->user, $this->pass, $this->db_name);

        if ($this->connection->connect_errno) {
            die("Koneksi gagal: " . $this->connection->connect_error);
        }
    }

    public function getConnection() {
        return $this->connection;
    }

    public function __destruct() {
        if ($this->connection) {
            $this->connection->close();
        }
    }
}
class Mahasiswaw {
    private $db;

    public function __construct($dbConnection) {
        $this->db = $dbConnection;
    }

    public function getAllData() {
        $query = "SELECT mahasiswa.id_mhs, mahasiswa.nama_mhs, mahasiswa.npm, mahasiswa.alamat, kelas.id_kls, kelas.nama_kelas, kelas.thn_akademik, prodi.id_prodi, prodi.nama_prodi FROM mahasiswa
                  JOIN kelas ON mahasiswa.id_mhs = kelas.id_mhs
                  JOIN prodi ON kelas.id_kls = prodi.id_kls";

        $result = $this->db->query($query);

        if ($result->num_rows > 0) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return [];
        }
    }
}

// Initialize Database and Mahasiswa
$db = new Database();
$connection = $db->getConnection();
$mahasiswa = new Mahasiswaw($connection);

// Get all data
$data = $mahasiswa->getAllData();
?>

