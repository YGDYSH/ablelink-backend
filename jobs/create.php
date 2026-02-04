<?php
include_once '../db.php';
header('Content-Type: application/json');

$user_id    = $_POST['user_id'];
$judul      = $_POST['judul'];
$perusahaan = $_POST['perusahaan'];
$lokasi     = $_POST['lokasi'];

$stmt = $conn->prepare("
    INSERT INTO jobs (user_id, judul, perusahaan, lokasi)
    VALUES (?, ?, ?, ?)
");

$stmt->bind_param("isss", $user_id, $judul, $perusahaan, $lokasi);

if ($stmt->execute()) {
    $last_id = $stmt->insert_id;

    echo json_encode([
        "status"  => "success",
        "message" => "Data jobs berhasil ditambahkan",
        "data"    => [
            "id"         => $last_id,
            "user_id"    => $user_id,
            "judul"      => $judul,
            "perusahaan" => $perusahaan,
            "lokasi"     => $lokasi
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
