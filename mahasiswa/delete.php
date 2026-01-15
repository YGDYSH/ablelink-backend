<?php
include '../db.php';

header('Content-Type: application/json');

$id = $_POST['id'];

$stmt = $conn->prepare("DELETE FROM tb_mahasiswa WHERE id = ?");
$stmt->bind_param("i", $id);

if ($stmt->execute()) {

    echo json_encode([
        "status"  => "success",
        "message" => "Data berhasil dihapus"
    ]);

} else {

    echo json_encode([
        "status"  => "error",
        "message" => $stmt->error
    ]);

}

$stmt->close();
$conn->close();
?>
