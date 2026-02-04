# Ablelink Backend API Documentation

## Deskripsi

## Aplikasi Ablelink adalah aplikasi backend berbasis PHP dan MySQL yang dikembangkan sebagai platform penghubung antara penyandang disabilitas dengan dunia kerja.
## Aplikasi ini bertujuan untuk memfasilitasi proses pencarian, pengelolaan, dan pengajuan lowongan kerja secara terstruktur, inklusif, dan mudah diakses.
## Melalui Ablelink, pengguna (penyandang disabilitas) dapat:
## Mendaftar dan mengelola data diri
## Melihat informasi lowongan pekerjaan
## Mengajukan lamaran pekerjaan (applications)
## Memantau status lamaran kerja
## Sementara itu, sistem juga mengelola data:
## Users sebagai pengguna sistem
## Profiles sebagai detail tambahan pengguna
## Jobs sebagai data lowongan pekerjaan
## Applications sebagai penghubung antara pengguna dan lowongan kerja
## Aplikasi ini dibangun menggunakan pendekatan RESTful API dengan format respons JSON, sehingga mudah diintegrasikan dengan aplikasi frontend (web maupun mobile) dan mendukung pengembangan sistem yang berorientasi pada inklusi sosial dan kesetaraan akses kerja bagi penyandang disabilitas. 

Nama database yang digunakan adalah:

```
ablelink_db
```

---

## Teknologi yang Digunakan

* PHP Native
* MySQL
* Laragon (Local Development)
* Postman (API Testing)

---

## Struktur Folder Project

```
BE-Latihan-kelas/
│
├── db.php
│
├── users/
│   ├── create.php
│   ├── read.php
│   ├── update.php
│   └── delete.php
│
├── profiles/
│   ├── create.php
│   ├── read.php
│   ├── update.php
│   └── delete.php
│
├── jobs/
│   ├── create.php
│   ├── read.php
│   ├── update.php
│   └── delete.php
│
├── applications/
│   ├── create.php
│   ├── read.php
│   ├── update.php
│   └── delete.php
│
└── README.md
```

---

## Konfigurasi Database

File `db.php`:

```php
<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "ablelink_db";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>
```

---

## Struktur Tabel Database

### 1. users

| Kolom    | Tipe    | Keterangan                  |
| -------- | ------- | --------------------------- |
| id       | INT     | Primary Key, Auto Increment |
| nama     | VARCHAR | Nama user                   |
| email    | VARCHAR | Email user                  |
| password | VARCHAR | Password                    |

---

### 2. profiles

| Kolom   | Tipe    | Keterangan           |
| ------- | ------- | -------------------- |
| id      | INT     | Primary Key          |
| user_id | INT     | Foreign Key ke users |
| alamat  | VARCHAR | Alamat               |
| no_hp   | VARCHAR | Nomor HP             |

---

### 3. jobs

| Kolom      | Tipe    | Keterangan              |
| ---------- | ------- | ----------------------- |
| id         | INT     | Primary Key             |
| user_id    | INT     | Foreign Key (owner job) |
| judul      | VARCHAR | Judul pekerjaan         |
| perusahaan | VARCHAR | Nama perusahaan         |
| lokasi     | VARCHAR | Lokasi                  |

---

### 4. applications

| Kolom   | Tipe    | Keterangan     |
| ------- | ------- | -------------- |
| id      | INT     | Primary Key    |
| user_id | INT     | Pelamar        |
| job_id  | INT     | Lowongan       |
| status  | VARCHAR | Status lamaran |

---

## Relasi Antar Tabel

* **users 1–1 profiles**
* **users 1–N jobs**
* **users 1–N applications**
* **jobs 1–N applications**

---

## Base URL

```
http://localhost/BE-Latihan-kelas
```

---

## Endpoint API

### Users

* `POST   /users/create.php`
* `GET    /users/read.php`
* `POST   /users/update.php`
* `POST   /users/delete.php`

---

### Profiles

* `POST   /profiles/create.php`
* `GET    /profiles/read.php`
* `POST   /profiles/update.php`
* `POST   /profiles/delete.php`

---

### Jobs

* `POST   /jobs/create.php`
* `GET    /jobs/read.php`
* `POST   /jobs/update.php`
* `POST   /jobs/delete.php`

---

### Applications

* `POST   /applications/create.php`
* `GET    /applications/read.php`
* `POST   /applications/update.php`
* `POST   /applications/delete.php`

---

## Contoh JOIN Query (Applications + Users + Jobs)

```sql
SELECT
    applications.id,
    users.nama,
    users.email,
    jobs.judul,
    jobs.perusahaan,
    applications.status
FROM applications
JOIN users ON applications.user_id = users.id
JOIN jobs ON applications.job_id = jobs.id;
```

---

## Format Response JSON

```json
{
  "status": "success",
  "data": []
}
```

---

## Catatan

* Semua endpoint mengembalikan response JSON
* Cocok untuk diuji menggunakan Postman
* Dikembangkan untuk kebutuhan pembelajaran backend API

---

## Author

Ablelink Backend API – PHP & MySQL
