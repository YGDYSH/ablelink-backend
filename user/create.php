<?php
// Koneksi ke database menggunakan file db.php
include_once '../db.php';

// Menentukan bahwa respon akan dalam format JSON
header('Content-Type: application/json');

// Mengambil data dari form POST
$nama     = $_POST['nama'];      // Nama pengguna
$email    = $_POST['email'];     // Email pengguna
$alamat    = $_POST['alamat'];   // Alamat mahasiswa
$role     = $_POST['role'];  // peran pengguna(apakah sebagai orangg yang memiliki disabilitas atau perusahaan yang mencari kerja)

// Mempersiapkan statement SQL untuk menyimpan data baru
// Gunakan prepared statement untuk mencegah SQL injection
$stmt = $conn->prepare("
    INSERT INTO users (nama, email, alamat, role)
    VALUES (?, ?, ?, ?)
");

// Mengikat parameter ke statement SQL
// "ssss" artinya: string, string, string, string
$stmt->bind_param("ssss", $nama, $email, $alamat, $role);

// Eksekusi statement
if ($stmt->execute()) {
    // Jika eksekusi berhasil, ambil ID terakhir yang dimasukkan
    $last_id = $stmt->insert_id;

    // Kirimkan respon sukses beserta data yang disimpan
    echo json_encode([
        "status"  => "success",
        "message" => "Data berhasil ditambahkan",
        "data"    => [
            "id"      => $last_id,
            "nama"     => $nama,
            "email"    => $email,
            "alamat"  => $alamat,
            "role" => $role
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
2. Nama kolom: Ganti 'nim', 'nama', 'alamat', 'no_telp' sesuai dengan kolom di tabel Anda
3. Parameter POST: Sesuaikan dengan nama field yang dikirim dari form Anda
4. Tipe data parameter: Perhatikan tipe data saat menggunakan bind_param()
   Misalnya: "iiis" untuk integer, integer, integer, string
*/
?>
