<?php
include_once '../db.php';
header('Content-Type: application/json');

$user_id = $_POST['user_id'];
$job_id  = $_POST['job_id'];
$status  = $_POST['status'];

$stmt = $conn->prepare("
    INSERT INTO applications (user_id, job_id, status)
    VALUES (?, ?, ?)
");

$stmt->bind_param("iis", $user_id, $job_id, $status);

if ($stmt->execute()) {
    $last_id = $stmt->insert_id;

    echo json_encode([
        "status"  => "success",
        "message" => "Data applications berhasil ditambahkan",
        "data"    => [
            "id"      => $last_id,
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

$stmt->close();
$conn->close();
?>
