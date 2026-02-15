<?php
// Koneksi ke database
include '../db.php';

// Response JSON
header('Content-Type: application/json');

// Ambil data dari POST
$id            = $_POST['id'];            // ID pendaftaran
$user_id       = $_POST['user_id'];       // ID user
$pelatihan_id  = $_POST['pelatihan_id'];  // ID pelatihan
$status        = $_POST['status'];        // Status pendaftaran

// Prepare statement UPDATE
$stmt = $conn->prepare("
    UPDATE pendaftaran_pelatihan
    SET 
        user_id = ?,
        pelatihan_id = ?,
        status = ?
    WHERE id = ?
");

// Bind parameter
$stmt->bind_param(
    "iisi",
    $user_id,
    $pelatihan_id,
    $status,
    $id
);

// Eksekusi
if ($stmt->execute()) {
    echo json_encode([
        "status"  => "success",
        "message" => "Data pendaftaran pelatihan berhasil diperbarui",
        "data"    => [
            "id"            => $id,
            "user_id"       => $user_id,
            "pelatihan_id"  => $pelatihan_id,
            "status"        => $status
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
