<?php
include('../koneksi.php');

// Ambil ID mahasiswa dari query parameter
$id_mhs = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($id_mhs > 0) {
    // Buat koneksi ke database
    $db = new Database();
    $connection = $db->getConnection();

    // Mulai transaksi
    $connection->begin_transaction();

    try {
        // Hapus data dari tabel 'prodi' terlebih dahulu (hapus berdasarkan id_kls)
        $stmt = $connection->prepare("DELETE FROM prodi WHERE id_kls IN (SELECT id_kls FROM kelas WHERE id_mhs = ?)");
        $stmt->bind_param("i", $id_mhs);
        $stmt->execute();
        $stmt->close();

        // Hapus data dari tabel 'kelas' (hapus berdasarkan id_mhs)
        $stmt = $connection->prepare("DELETE FROM kelas WHERE id_mhs = ?");
        $stmt->bind_param("i", $id_mhs);
        $stmt->execute();
        $stmt->close();

        // Hapus data dari tabel 'mahasiswa'
        $stmt = $connection->prepare("DELETE FROM mahasiswa WHERE id_mhs = ?");
        $stmt->bind_param("i", $id_mhs);
        $stmt->execute();
        $stmt->close();

        // Commit transaksi
        $connection->commit();

        // Redirect setelah berhasil
        header("Location: ../interface/headerList.php");
        exit();
    } catch (Exception $e) {
        // Rollback jika terjadi error
        $connection->rollback();
        echo "Terjadi kesalahan: " . $e->getMessage();
    } finally {
        // Tutup koneksi
        $connection->close();
    }
} else {
    echo "ID mahasiswa tidak valid.";
}
?>
