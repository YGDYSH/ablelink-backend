<?php
// Header JSON (penting untuk Postman / API)
header('Content-Type: application/json; charset=utf-8');

// Panggil koneksi database
require_once '../db.php';

// Query JOIN profiles dan users
$sql = "
    SELECT
        profiles.id,
        profiles.user_id,
        profiles.alamat,
        profiles.no_hp,
        profiles.jenis_disabilitas,
        users.nama,
        users.email,
        users.role
    FROM profiles
    INNER JOIN users
        ON profiles.user_id = users.id
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
