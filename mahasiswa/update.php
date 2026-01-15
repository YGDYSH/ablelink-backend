<?php
include '../db.php';

header('Content-Type: application/json');

$id      = $_POST['id'];
$nim     = $_POST['nim'];
$nama    = $_POST['nama'];
$alamat  = $_POST['alamat'];
$no_telp = $_POST['no_telp'];

$stmt = $conn->prepare("
    UPDATE tb_mahasiswa 
    SET nim = ?, nama = ?, alamat = ?, no_telp = ?
    WHERE id = ?
");
$stmt->bind_param("ssssi", $nim, $nama, $alamat, $no_telp, $id);

if ($stmt->execute()) {

    echo json_encode([
        "status"  => "success",
        "message" => "Data berhasil diperbarui",
        "data"    => [
            "id"      => $id,
            "nim"     => $nim,
            "nama"    => $nama,
            "alamat"  => $alamat,
            "no_telp" => $no_telp
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
