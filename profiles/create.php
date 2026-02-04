<?php
include_once '../db.php';
header('Content-Type: application/json');

$user_id          = $_POST['user_id'];
$alamat           = $_POST['alamat'];
$no_hp            = $_POST['no_hp'];
$jenis_disabilitas = $_POST['jenis_disabilitas'];

$stmt = $conn->prepare("
    INSERT INTO profiles (user_id, alamat, no_hp, jenis_disabilitas)
    VALUES (?, ?, ?, ?)
");

$stmt->bind_param("isss", $user_id, $alamat, $no_hp, $jenis_disabilitas);

if ($stmt->execute()) {
    $last_id = $stmt->insert_id;

    echo json_encode([
        "status"  => "success",
        "message" => "Data profiles berhasil ditambahkan",
        "data"    => [
            "id"                => $last_id,
            "user_id"           => $user_id,
            "alamat"            => $alamat,
            "no_hp"             => $no_hp,
            "jenis_disabilitas" => $jenis_disabilitas
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
