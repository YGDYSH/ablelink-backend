<?php
include '../db.php';
header('Content-Type: application/json');

$data = [];

$sql = "
    SELECT
        pelatihan.id,
        pelatihan.judul,
        pelatihan.deskripsi,
        pelatihan.penyelenggara,
        pelatihan.lokasi,
        pelatihan.tanggal_mulai,
        pelatihan.tanggal_selesai,
        users.nama AS nama_user
    FROM pelatihan
    JOIN users ON pelatihan.user_id = users.id
";

$result = $conn->query($sql);

while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

echo json_encode([
    "status"  => "success",
    "message" => count($data) > 0 ? "Data join ditemukan" : "Data kosong",
    "data"    => $data
]);

$conn->close();
?>
