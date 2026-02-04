<?php
// Koneksi ke database menggunakan file db.php
include '../db.php';

// Menentukan bahwa respon akan dalam format JSON
header('Content-Type: application/json');

// Mengambil ID dari form POST untuk mengetahui record mana yang akan dihapus
$id = $_POST['id'];

// Mempersiapkan statement SQL untuk menghapus data
// Gunakan prepared statement untuk mencegah SQL injection
$stmt = $conn->prepare("DELETE FROM jobs WHERE id = ?");

// Mengikat parameter ke statement SQL
// "i" artinya integer
$stmt->bind_param("i", $id);

// Eksekusi statement
if ($stmt->execute()) {
    // Jika eksekusi berhasil, kirimkan respon sukses
    echo json_encode([
        "status"  => "success",
        "message" => "Data berhasil dihapus"
    ]);

} else {
    // Jika eksekusi gagal, kirimkan pesan error
    echo json_encode([
        "status"  => "error",
        "message" => $stmt->error
    ]);

}

// Menutup statement dan koneksi database
$stmt->close();
$conn->close();

/*
PETUNJUK UNTUK MENYESUAIKAN DENGAN SCHEMA TABEL LAIN:

Jika ingin menggunakan skema tabel yang berbeda, ubah bagian-bagian berikut:
1. Nama tabel: Ganti 'tb_mahasiswa' dengan nama tabel Anda
2. Nama kolom: Ganti 'id' sesuai dengan kolom primary key di tabel Anda
3. Parameter POST: Sesuaikan dengan nama field yang dikirim dari form Anda
4. Tipe data parameter: Perhatikan tipe data saat menggunakan bind_param()
   Misalnya: "s" untuk string, "ii" untuk dua integer
*/
?>
