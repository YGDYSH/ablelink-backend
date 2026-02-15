<?php
include '../db.php';
header('Content-Type: application/json');

$data = [];

$sql = "
    SELECT
        pendaftaran_pelatihan.id,
        pendaftaran_pelatihan.status,

        users.id AS user_id,
        users.nama AS nama_user,

        pelatihan.id AS pelatihan_id,
        pelatihan.judul,
        pelatihan.deskripsi,
        pelatihan.penyelenggara,
        pelatihan.lokasi,
        pelatihan.tanggal_mulai,
        pelatihan.tanggal_selesai
    FROM pendaftaran_pelatihan
    INNER JOIN users
        ON pendaftaran_pelatihan.user_id = users.id
    INNER JOIN pelatihan
        ON pendaftaran_pelatihan.pelatihan_id = pelatihan.id
";

$result = $conn->query($sql);

while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

echo json_encode([
    "status"  => "success",
    "message" => count($data) > 0 ? "Data pendaftaran pelatihan ditemukan" : "Data kosong",
    "data"    => $data
]);

$conn->close();
?>
