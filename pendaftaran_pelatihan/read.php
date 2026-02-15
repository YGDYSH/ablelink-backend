<?php
// Koneksi ke database
include '../db.php';

// Response JSON
header('Content-Type: application/json');

// Array untuk menyimpan data
$data = [];

// Jika ada parameter GET 'id', ambil data berdasarkan id
if (isset($_GET['id'])) {

    $id = $_GET['id'];

    $stmt = $conn->prepare("SELECT * FROM pendaftaran_pelatihan WHERE id = ?");
    $stmt->bind_param("i", $id);

    $stmt->execute();
    $result = $stmt->get_result();

    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }

    $stmt->close();

} else {
    // Jika tidak ada parameter, ambil semua data
    $sql = "SELECT * FROM pendaftaran_pelatihan";
    $result = $conn->query($sql);

    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}

// Kirim response JSON
echo json_encode([
    "status"  => "success",
    "message" => count($data) > 0 ? "Data ditemukan" : "Data kosong",
    "data"    => $data
]);

// Tutup koneksi
$conn->close();
?>
