<?php
include_once '../db.php';
header('Content-Type: application/json');

$user_id        = $_POST['user_id'];
$pelatihan_id   = $_POST['pelatihan_id'];
$tanggal_daftar = $_POST['tanggal_daftar'];
$status         = $_POST['status'];

$stmt = $conn->prepare("
    INSERT INTO pendaftaran_pelatihan
    (user_id, pelatihan_id, tanggal_daftar, status)
    VALUES (?, ?, ?, ?)
");

$stmt->bind_param(
    "iiss",
    $user_id,
    $pelatihan_id,
    $tanggal_daftar,
    $status
);

if ($stmt->execute()) {
    echo json_encode([
        "status"  => "success",
        "message" => "Pendaftaran berhasil",
        "data"    => [
            "id"             => $stmt->insert_id,
            "user_id"        => $user_id,
            "pelatihan_id"   => $pelatihan_id,
            "tanggal_daftar" => $tanggal_daftar,
            "status"         => $status
        ]
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
