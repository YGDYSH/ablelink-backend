<?php
// Koneksi ke database
include '../db.php';

// Response JSON
header('Content-Type: application/json');

// Ambil data dari POST
$id                = $_POST['id'];        // ID profile yang akan diupdate
$user_id           = $_POST['user_id'];   // ID user
$alamat             = $_POST['alamat'];    // Alamat
$no_hp              = $_POST['no_hp'];     // Nomor HP
$jenis_disabilitas  = $_POST['jenis_disabilitas']; // Jenis disabilitas

// Prepare statement UPDATE
$stmt = $conn->prepare("
    UPDATE profiles
    SET user_id = ?, alamat = ?, no_hp = ?, jenis_disabilitas = ?
    WHERE id = ?
");

// Bind parameter
$stmt->bind_param("isssi", $user_id, $alamat, $no_hp, $jenis_disabilitas, $id);

// Eksekusi
if ($stmt->execute()) {
    echo json_encode([
        "status"  => "success",
        "message" => "Data profiles berhasil diperbarui",
        "data"    => [
            "id"                => $id,
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

// Tutup koneksi
$stmt->close();
$conn->close();
?>
