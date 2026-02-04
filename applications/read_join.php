<?php
// Header JSON (penting untuk Postman / API)
header('Content-Type: application/json; charset=utf-8');

// Panggil koneksi database
require_once '../db.php';

// Query JOIN users dan jobs
$sql = "
    SELECT
        users.nama,
        users.email,
        jobs.judul,
        jobs.perusahaan,
        jobs.lokasi
    FROM users
    INNER JOIN jobs
        ON users.id = jobs.user_id
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
    // Jika data kosong
    echo json_encode([
        "status" => "success",
        "total_data" => 0,
        "data" => []
    ], JSON_PRETTY_PRINT);
}

// Tutup koneksi
$conn->close();
