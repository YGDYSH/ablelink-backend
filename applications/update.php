<?php
// Koneksi ke database
include '../db.php';

// Response JSON
header('Content-Type: application/json');

// Ambil data dari POST
$id      = $_POST['id'];       // ID application yang akan diupdate
$user_id = $_POST['user_id'];  // ID user
$job_id  = $_POST['job_id'];   // ID job
$status  = $_POST['status'];   // Status lamaran

// Prepare statement UPDATE
$stmt = $conn->prepare("
    UPDATE applications
    SET user_id = ?, job_id = ?, status = ?
    WHERE id = ?
");

// Bind parameter
// i = integer, s = string
$stmt->bind_param("iisi", $user_id, $job_id, $status, $id);

// Eksekusi
if ($stmt->execute()) {
    echo json_encode([
        "status"  => "success",
        "message" => "Data application berhasil diperbarui",
        "data"    => [
            "id"      => $id,
            "user_id" => $user_id,
            "job_id"  => $job_id,
            "status"  => $status
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