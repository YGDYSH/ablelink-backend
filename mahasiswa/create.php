<?php
include '../db.php';

$nim = $_POST['nim'];
$nama = $_POST['nama'];
$alamat = $_POST['alamat'];
$no_telp = $_POST['no_telp'];

$stmt = $conn->prepare("INSERT INTO tb_mahasiswa (nim, nama, alamat, no_telp) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssss", $nim, $nama, $alamat, $no_telp);

if ($stmt->execute() === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
