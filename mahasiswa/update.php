<?php
include '../db.php';

$id = $_POST['id'];
$nim = $_POST['nim'];
$nama = $_POST['nama'];
$alamat = $_POST['alamat'];
$no_telp = $_POST['no_telp'];

$stmt = $conn->prepare("UPDATE tb_mahasiswa SET nim=?, nama=?, alamat=?, no_telp=? WHERE id=?");
$stmt->bind_param("ssssi", $nim, $nama, $alamat, $no_telp, $id);

if ($stmt->execute() === TRUE) {
    echo "Record updated successfully";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
