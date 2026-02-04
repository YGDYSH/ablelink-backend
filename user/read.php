<?php
// Koneksi ke database menggunakan file db.php
include '../db.php';

// Menentukan bahwa respon akan dalam format JSON
header('Content-Type: application/json');

// Array untuk menyimpan data hasil query
$data = [];

// Cek apakah ada parameter GET 'nim' atau 'id'
// Jika ada, maka hanya ambil data spesifik berdasarkan parameter tersebut
if (isset($_GET['nama']) || isset($_GET['id'])) {

    // Jika parameter 'nim' disediakan, cari berdasarkan nim
    if (isset($_GET['nama'])) {
        $nim = $_GET['nama'];
        // Mempersiapkan statement SQL untuk mencari data berdasarkan nim
        $stmt = $conn->prepare("SELECT * FROM users WHERE nama = ?");
        $stmt->bind_param("s", $nama);  // "s" artinya string
    } else {
        // Jika parameter 'id' disediakan, cari berdasarkan id
        $id = $_GET['id'];
        // Mempersiapkan statement SQL untuk mencari data berdasarkan id
        $stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->bind_param("i", $id);  // "i" artinya integer
    }

    // Eksekusi statement
    $stmt->execute();
    // Ambil hasil query
    $result = $stmt->get_result();

    // Loop melalui hasil dan tambahkan ke array data
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }

    // Tutup statement
    $stmt->close();

} else {
    // Jika tidak ada parameter GET, ambil semua data dari tabel
    $sql = "SELECT * FROM users";
    $result = $conn->query($sql);

    // Loop melalui semua hasil dan tambahkan ke array data
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}

// Kirimkan data dalam format JSON
echo json_encode([
    "status"  => "success",
    "message" => count($data) > 0 ? "Data ditemukan" : "Data kosong",
    "data"    => $data
]);

// Tutup koneksi database
$conn->close();

/*
PETUNJUK UNTUK MENYESUAIKAN DENGAN SCHEMA TABEL LAIN:

Jika ingin menggunakan skema tabel yang berbeda, ubah bagian-bagian berikut:
1. Nama tabel: Ganti 'tb_mahasiswa' dengan nama tabel Anda
2. Nama kolom: Ganti 'nim', 'id' sesuai dengan kolom pencarian di tabel Anda
3. Parameter GET: Sesuaikan dengan nama parameter yang ingin Anda gunakan untuk pencarian
4. Tipe data parameter: Perhatikan tipe data saat menggunakan bind_param()
   Misalnya: "ii" untuk dua integer, "ss" untuk dua string
*/
?>
