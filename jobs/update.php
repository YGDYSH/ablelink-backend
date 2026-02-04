<?php
// Koneksi ke database menggunakan file db.php
include '../db.php';

// Menentukan bahwa respon akan dalam format JSON
header('Content-Type: application/json');

// Mengambil data dari form POST
$id      = $_POST['id'];       // ID untuk mengetahui record mana yang akan diupdate
$user_id     = $_POST['user_id'];      // Nomor Induk Mahasiswa
$judul    = $_POST['judul'];     // Nama mahasiswa
$perusahaan   = $_POST['perusahaan'];   // Alamat mahasiswa
$lokasi    = $_POST['lokasi'];  // Nomor telepon mahasiswa

// Mempersiapkan statement SQL untuk mengupdate data
// Gunakan prepared statement untuk mencegah SQL injection
$stmt = $conn->prepare("
    UPDATE jobs
    SET user_id = ?, judul = ?, perusahaan = ?, lokasi = ?
    WHERE id = ?
");

// Mengikat parameter ke statement SQL
// "ssssi" artinya: string, string, string, string, integer
$stmt->bind_param("isssi", $user_id, $judul, $perusahaan, $lokasi, $id);

// Eksekusi statement
if ($stmt->execute()) {
    // Jika eksekusi berhasil, kirimkan respon sukses
    echo json_encode([
        "status"  => "success",
        "message" => "Data berhasil diperbarui",
        "data"    => [
           "id"         => $id,
            "judul"      => $judul,
            "perusahaan" => $perusahaan,
            "lokasi"     => $lokasi,
            "user_id"    => $user_id

        ]
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
2. Nama kolom: Ganti 'id', 'nim', 'nama', 'alamat', 'no_telp' sesuai dengan kolom di tabel Anda
3. Parameter POST: Sesuaikan dengan nama field yang dikirim dari form Anda
4. Tipe data parameter: Perhatikan tipe data saat menggunakan bind_param()
   Misalnya: "iiiss" untuk integer, integer, integer, string, string
*/
?>
