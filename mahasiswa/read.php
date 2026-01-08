<?php
include '../db.php';

// Check if specific ID is requested
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM tb_mahasiswa WHERE id = $id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $data = [$row]; // Return as array to maintain compatibility
    } else {
        $data = [];
    }
} else {
    // Get all records
    $sql = "SELECT * FROM tb_mahasiswa";
    $result = $conn->query($sql);

    $data = array();
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
    }
}

echo json_encode($data);

$conn->close();
?>
