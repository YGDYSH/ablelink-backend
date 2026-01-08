<?php
include '../db.php';

$id = $_POST['id'];

$stmt = $conn->prepare("DELETE FROM tb_mahasiswa WHERE id=?");
$stmt->bind_param("i", $id);

if ($stmt->execute() === TRUE) {
    echo "Record deleted successfully";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
