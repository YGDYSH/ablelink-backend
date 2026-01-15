<?php
include '../db.php';

header('Content-Type: application/json');

$data = [];

if (isset($_GET['nim']) || isset($_GET['id'])) {

    if (isset($_GET['nim'])) {
        $nim = $_GET['nim'];
        $stmt = $conn->prepare("SELECT * FROM tb_mahasiswa WHERE nim = ?");
        $stmt->bind_param("s", $nim);
    } else {
        $id = $_GET['id'];
        $stmt = $conn->prepare("SELECT * FROM tb_mahasiswa WHERE id = ?");
        $stmt->bind_param("i", $id);
    }

    $stmt->execute();
    $result = $stmt->get_result();

    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }

    $stmt->close();

} else {

    // Ambil semua data
    $sql = "SELECT * FROM tb_mahasiswa";
    $result = $conn->query($sql);

    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}

echo json_encode([
    "status"  => "success",
    "message" => count($data) > 0 ? "Data ditemukan" : "Data kosong",
    "data"    => $data
]);

$conn->close();
?>
