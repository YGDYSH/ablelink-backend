<?php
// Header JSON (penting untuk Postman / API)
header('Content-Type: application/json; charset=utf-8');

// Panggil koneksi database
require_once '../db.php';

// Query JOIN applications, users, dan jobs
$sql = "
    SELECT
        applications.id,
        applications.user_id,
        applications.job_id,
        applications.status,
        users.nama,
        users.email,
        jobs.judul,
        jobs.perusahaan,
        jobs.lokasi
    FROM applications
    INNER JOIN users
        ON applications.user_id = users.id
    INNER JOIN jobs
        ON applications.job_id = jobs.id
";

// Eksekusi query
$result = $conn->query($sql);

// Siapkan array data
$data = [];

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }

    echo json_encode([
        "status" => "success",
        "total_data" => count($data),
        "data" => $data
    ], JSON_PRETTY_PRINT);

} else {
    echo json_encode([
        "status" => "success",
        "total_data" => 0,
        "data" => []
    ], JSON_PRETTY_PRINT);
}

// Tutup koneksi
$conn->close();
?>
