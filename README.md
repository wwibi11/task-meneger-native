# 📝 Task Manager — PHP Native
> Aplikasi manajemen tugas sederhana dengan PHP Native (PDO) + MySQL, dibuat sebagai latihan sebelum migrasi ke Laravel.

```markdown
[![PHP](https://img.shields.io/badge/PHP-8.0%2B-777BB4?logo=php&logoColor=white)](https://www.php.net/)
[![MySQL](https://img.shields.io/badge/MySQL-8.0-4479A1?logo=mysql&logoColor=white)](https://www.mysql.com/)
[![PDO](https://img.shields.io/badge/PDO-Prepared%20Statement-blue)]()
[![License: MIT](https://img.shields.io/badge/License-MIT-green.svg)](LICENSE)
```

## 📋 Daftar Isi
```
- [Tentang Proyek](#-tentang-proyek)
- [Fitur](#-fitur)
- [Teknologi](#-teknologi)
- [Struktur Folder](#-struktur-folder)
- [Instalasi](#-instalasi)
- [Screenshot](#-screenshot)
- [Tujuan Pembelajaran](#-tujuan-pembelajaran)
- [Roadmap](#️-roadmap)
- [Lisensi](#-lisensi)
```

## 🎯 Tentang Proyek
```
Task Manager adalah aplikasi CRUD tugas yang sengaja dibuat "lebih dari sekadar CRUD dasar". Proyek ini menjadi jembatan antara belajar PHP Native dan Laravel, dengan menerapkan konsep-konsep yang nantinya akan otomatis ditangani oleh framework.

Cocok untuk pemula yang ingin:
- Memahami alur request → validasi → query → response tanpa "keajaiban" framework
- Melatih penggunaan **PDO Prepared Statement** dengan benar
- Mempersiapkan diri sebelum belajar **Laravel (Eloquent, Blade, Validation)**
```


## ✨ Fitur
```
| Fitur | Deskripsi |
|-------|-----------|
| ✅ **CRUD Task** | Tambah, lihat, edit, dan hapus tugas |
| 🎯 **Prioritas** | Rendah, Sedang, Tinggi dengan badge berwarna |
| 📅 **Deadline** | Deteksi otomatis tugas yang sudah terlambat |
| 🔍 **Filter Status** | Semua / Belum Selesai / Selesai |
| 🔀 **Sorting Dinamis** | Deadline terdekat, prioritas tertinggi, atau terbaru |
| 🔄 **Toggle Status** | Tandai selesai / belum selesai dengan satu klik |
| 📊 **Statistik Ringkas** | Total, selesai, belum, dan terlambat |
| 🛡️ **Prepared Statement** | Aman dari SQL Injection |
| 🔒 **Whitelist Sorting** | Kolom sorting divalidasi agar tidak bisa dieksploitasi |
```


## 🧰 Teknologi
```
| Komponen | Keterangan |
|----------|------------|
| **PHP** | 8.0+ (menggunakan `match` expression) |
| **Database** | MySQL / MariaDB |
| **Driver** | PDO (Prepared Statement) |
| **Frontend** | HTML + CSS murni (tanpa framework) |

```




## 📁 Struktur Folder
```markdown
task-manager/
├── config/
│   └── database.php        # Koneksi PDO
├── helpers/
│   └── functions.php       # Fungsi bantu (escape, badge, format tanggal)
├── includes/
│   ├── header.php          # Layout atas
│   └── footer.php          # Layout bawah
├── actions/
│   ├── toggle.php          # Ubah status selesai/belum
│   └── delete.php          # Hapus task
├── index.php               # Daftar task + filter + statistik
├── create.php              # Form tambah
├── edit.php                # Form edit
├── style.css
└── README.md
```


## 🚀 Instalasi
### 1. Clone Repository

```bash
git clone https://github.com/username/task-manager-php-native.git
cd task-manager-php-native
```

### 2. Buat Database
Jalankan SQL berikut di phpMyAdmin atau MySQL client:

```sql
CREATE DATABASE task_manager;
USE task_manager;

CREATE TABLE tasks (
  id INT AUTO_INCREMENT PRIMARY KEY,
  judul VARCHAR(150) NOT NULL,
  deskripsi TEXT,
  prioritas ENUM('rendah','sedang','tinggi') DEFAULT 'sedang',
  status ENUM('belum','selesai') DEFAULT 'belum',
  deadline DATE NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```

### 3. Konfigurasi Database

Edit `config/database.php` sesuai kredensial lokal:

```php
$host = 'localhost';
$db   = 'task_manager';
$user = 'root';
$pass = '';
```

### 4. Jalankan Aplikasi

**Opsi A — XAMPP / Laragon / MAMP**

Pindahkan folder ke `htdocs/` (XAMPP) atau `www/` (Laragon), lalu buka:

```
http://localhost/task-manager
```

**Opsi B — PHP Built-in Server**

```bash
php -S localhost:8000
```

Lalu buka `http://localhost:8000`.

---

## 🖼️ Screenshot

> Tambahkan screenshot setelah aplikasi berjalan.

| Halaman Utama | Form Tambah |
|:---:|:---:|
| ![Halaman Utama](screenshots/index.png) | ![Form Tambah](screenshots/create.png) |

---

## 🎓 Tujuan Pembelajaran

Proyek ini dibuat "lebih dari CRUD dasar" agar menjadi bekal sebelum pindah ke Laravel. Konsep yang dilatih:

| Di PHP Native | Nanti di Laravel |
|---------------|------------------|
| PDO & Prepared Statement | Eloquent ORM |
| Validasi manual `if (...)` | `$request->validate()` |
| Whitelist sorting | Query Builder |
| Escape HTML manual `e()` | Blade `{{ }}` (otomatis) |
| Redirect via `header()` | `redirect()->route()` |
| Pemisahan header/footer | Blade layout `@extends` & `@section` |

---

## 🗺️ Roadmap

- [x] CRUD dasar
- [x] Filter & sorting
- [x] Deteksi deadline terlambat
- [x] Statistik ringkas
- [ ] Refactor ke pola MVC + OOP
- [ ] Versi Laravel (migration, Eloquent, Blade)

---

## 📄 Lisensi

Didistribusikan di bawah **MIT License**. Bebas digunakan untuk belajar.

Lihat [`LICENSE`](LICENSE) untuk detail.

---

<p align="center">
  Dibuat dengan ❤️ sebagai latihan belajar PHP Native sebelum Laravel
</p>
```

---

## 🏷️ Description Repo (kolom About)

Isi kolom **Description** di halaman utama repo dengan versi singkat ini:

```
Task Manager PHP Native — CRUD tugas dengan prioritas, deadline, filter status, sorting dinamis, deteksi keterlambatan, dan statistik. Dibangun dengan PDO + MySQL sebagai latihan sebelum migrasi ke Laravel. 🚀
```

---

## 🔖 Topics yang Disarankan

Tambahkan di bagian **Topics** repo:

```
php  php-native  mysql  pdo  crud  task-manager  todo-app  beginner-project  learning-php  laravel-prep
```

---

## 📌 Tips Tambahan Biar README Makin Rapi

1. **Screenshot**: buat folder `screenshots/` di root, isi dengan `index.png` dan `create.png`. README di atas sudah mereferensikannya.
2. **Ganti `username`** di bagian clone URL dengan username GitHub-mu.
3. **Tambahkan file `LICENSE`** di root (MIT License) — cukup ambil template dari [choosealicense.com](https://choosealicense.com/licenses/mit/).
4. **Pin repo** di profil GitHub-mu supaya tampil di halaman utama profil.

---

Kalau mau, saya bisa lanjut bantu buatkan **file `LICENSE` (MIT)** dan **`.gitignore` khusus PHP** biar repo-nya lengkap dan langsung rapi dari commit pertama.