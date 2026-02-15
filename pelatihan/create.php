<?php
include_once '../db.php';
header('Content-Type: application/json');

$judul            = $_POST['judul'];
$deskripsi        = $_POST['deskripsi'];
$penyelenggara    = $_POST['penyelenggara'];
$lokasi           = $_POST['lokasi'];
$tanggal_mulai    = $_POST['tanggal_mulai'];
$tanggal_selesai  = $_POST['tanggal_selesai'];

$stmt = $conn->prepare("
    INSERT INTO pelatihan 
    (judul, deskripsi, penyelenggara, lokasi, tanggal_mulai, tanggal_selesai)
    VALUES (?, ?, ?, ?, ?, ?)
");

$stmt->bind_param(
    "ssssss",
    $judul,
    $deskripsi,
    $penyelenggara,
    $lokasi,
    $tanggal_mulai,
    $tanggal_selesai
);

if ($stmt->execute()) {
    $last_id = $stmt->insert_id;

    echo json_encode([
        "status"  => "success",
        "message" => "Data pelatihan berhasil ditambahkan",
        "data"    => [
            "id"               => $last_id,
            "judul"            => $judul,
            "deskripsi"        => $deskripsi,
            "penyelenggara"    => $penyelenggara,
            "lokasi"           => $lokasi,
            "tanggal_mulai"    => $tanggal_mulai,
            "tanggal_selesai"  => $tanggal_selesai
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
