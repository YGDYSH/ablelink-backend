<?php
// Koneksi ke database
include '../db.php';

// Response JSON
header('Content-Type: application/json');

// Ambil data dari POST
$id               = $_POST['id'];               // ID pelatihan
$judul            = $_POST['judul'];
$deskripsi        = $_POST['deskripsi'];
$penyelenggara    = $_POST['penyelenggara'];
$lokasi           = $_POST['lokasi'];
$tanggal_mulai    = $_POST['tanggal_mulai'];
$tanggal_selesai  = $_POST['tanggal_selesai'];

// Prepare statement UPDATE
$stmt = $conn->prepare("
    UPDATE pelatihan
    SET 
        judul = ?,
        deskripsi = ?,
        penyelenggara = ?,
        lokasi = ?,
        tanggal_mulai = ?,
        tanggal_selesai = ?
    WHERE id = ?
");

// Bind parameter
// s = string, i = integer
$stmt->bind_param(
    "ssssssi",
    $judul,
    $deskripsi,
    $penyelenggara,
    $lokasi,
    $tanggal_mulai,
    $tanggal_selesai,
    $id
);

// Eksekusi
if ($stmt->execute()) {
    echo json_encode([
        "status"  => "success",
        "message" => "Data pelatihan berhasil diperbarui",
        "data"    => [
            "id"               => $id,
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

// Tutup koneksi
$stmt->close();
$conn->close();
?>
