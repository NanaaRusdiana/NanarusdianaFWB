## <p align="center" style="margin-top: 0;">SISTEM PENGARSIPAN SKRIPSI DI PRODI INFORMATIKA</p>

<p align="center">
  <img src="/public/LogoUnsulbar.png" width="300" alt="LogoUnsulbar" />
</p>

### <p align="center">NANA RUSDIANA</p>

### <p align="center">D022056</p></br>

### <p align="center">FRAMEWORK WEB BASED</p>

### <p align="center">2025</p>

## 🧑‍🤝‍🧑 Role dan Hak Akses

| Role         | Akses                                                                              |
|--------------|-----------------------------------------------------------------------------------|
| *Admin*      | Mengelola semua data (user, skripsi, kategori), menambah/mengedit/menghapus data, melihat laporan aktivitas dan download |
| *Dosen*      | 	Membimbing skripsi, mereview skripsi, memberikan catatan revisi, melihat daftar skripsi |
| *Mahasiswar*   | 	Mengunggah skripsi, mengelola skripsi milik sendiri, melihat daftar skripsi, mengedit profil |

---

## 🗃 Struktur Database

### 1. Tabel users

| Field          | Tipe Data        | Keterangan                                |
|----------------|------------------|-------------------------------------------|
| id             | bigint (PK)      | ID unik                                   |
| name           | varchar          | Nama lengkap user                         |
| email          | varchar (unique) | Alamat email                              |
| password       | varchar          | Password terenkripsi                      |
| role           | enum             | admin,dosen,mahasiswa (default: mahasiswa)|
| nim            | varchar          | Nomor induk mahasiswa(untuk mahasiswa)    |
| nind           | varchar          | Nomor induk dosen(untuk dosen)            |
| prodi          | varchar          | program studi                             |
| remember_token | varchar          | Token untuk remember me                   |
| create_at      | timestamp        | Tanggal dibuat                            |
| updated_at     | timestamp        | Tanggal update                            |

### 2. Tabel Skripsi(tugas akhir)

| Field       | Tipe Data   | Keterangan                     |
|-------------|-------------|--------------------------------|
| id          | bigint (PK) | ID skripsi                     |
| judul       | varchar     | judul skripsi                  |
| abstrack    | text        | abstrack skripsi               |
| mahasiswa_id| bigint(FK)  | Relasi ke user(mahasiswa)      |
| pembimbing_1| bigint(FK)  | Relasi ke user(dosen)          |
| pembimbing_2| bigint(FK)  | Relasi ke user(dosen)          |
| tahun       | varchar(4)  | Tahun skripsi                  |
| file_path   | varchar     | path file skripsi              |
| file_size   | bigint      | ukuran file(bytes)             |
|file_type    | varchar(50) | Tipe file                      |
| status      |enum         | draf/pending/approved/rejected |
| catatan_reviewer | text   | catatan dari review            |
| create_at   | timestamp   | Tanggal dibuat                 |
| updated_at  | timestamp   | Tanggal update                 |

### 3. Tabel Kategoris

| Field        | Tipe Data   | Keterangan                     |
|--------------|-------------|--------------------------------|
| id           | bigint (PK) | ID kategori                    |
| nama         | varchar     | nama kategori                  |
| slug         | varchar     | URL-friendly version           |
| deskripsi    | text        | Deskripsi Kategori             |
| created_at   | timestamp   | Tanggal dibuat                 |
| updated_at   | timestamp   | Tanggal update                 |

### 4. Tabel Notifikasi

| Field            | Tipe Data   | Keterangan                     |
|------------------|-------------|--------------------------------|
| id               | bigint (PK) | ID notifikasi                  |
| user_id          | bigint (FK) | Relasi ke users                |
| title            | varchar     | Judul notifikasi               |
| message          | text        | Isi notifikasi                 |
| id_read          | boolean     | status baca                    |
| url              | varchar     | link terkait notifikasi        |
| created_at       | timestamp   | Tanggal dibuat                 |
| updated_at       | timestamp   | Tanggal update                 |

---

## 🔗 Relasi Antar Tabel

| Tabel Asal  | Tabel Tujuan | Relasi      | Penjelasan                                   |
|-------------|--------------|-------------|----------------------------------------------|
| users       | skripsi      | one-to-many | Satu mahasiswa bisa memiliki banyak skripsi  |
| users       | skripsi      | one-to-many | Satu dosen bisa membimbing banyak skripsi    |
|Skripsi      |kategoris     | one-to-many | Satu skripsi bisa memiliki banyak kategori   |
|user         | notifikasi   | one-to-many | Satu user bisa memiliki banyak notifikasi    |
