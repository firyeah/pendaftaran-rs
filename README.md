# 🏥 Pendaftaran RS - Sistem Informasi Pendaftaran Pasien

![Version](https://img.shields.io/badge/version-1.0.0-blue.svg)
![License](https://img.shields.io/badge/license-MIT-green.svg)
![PHP](https://img.shields.io/badge/PHP-%3E%3D7.4-purple.svg)

Sistem Informasi Pendaftaran Pasien untuk Rumah Sakit Esa Unggul - Aplikasi web yang dirancang untuk mengelola pendaftaran pasien baru, data pasien, dan rekam medis (resume medis) dengan mudah dan efisien.

## ✨ Fitur Utama

### 1. **Manajemen Pendaftaran Pasien**
- ✅ Pendaftaran pasien baru dengan form yang user-friendly
- ✅ Validasi data input (NIK, No HP, Email, dll)
- ✅ Auto-generate nomor RM (Rekam Medis)
- ✅ Input data lengkap: identitas, alamat, kontak, pekerjaan

### 2. **Data Pasien**
- ✅ Lihat daftar semua pasien terdaftar
- ✅ Cari pasien berdasarkan nama, NIK, atau No RM
- ✅ Filter dan sort data
- ✅ Pagination untuk data besar

### 3. **Edit & Update Pasien**
- ✅ Update informasi pasien
- ✅ Edit data personal, alamat, kontak
- ✅ History perubahan data
- ✅ Validasi pada setiap update

### 4. **Rekam Medis (Resume Medis)**
- ✅ Catat setiap kunjungan pasien
- ✅ Input diagnosis dan tindakan medis
- ✅ Tracking biaya kunjungan
- ✅ Lihat history medis per pasien

### 5. **Dashboard**
- ✅ Overview statistik pasien
- ✅ Pasien baru hari ini
- ✅ Total kunjungan
- ✅ Total biaya kunjungan
- ✅ Quick actions

## 🛠️ Tech Stack

| Komponen | Teknologi |
|----------|-----------|
| **Backend** | PHP 7.4+ (OOP & MVC) |
| **Database** | MySQL 5.7+ / MariaDB |
| **Frontend** | HTML5, CSS3 (Tailwind CSS 3) |
| **Server** | Apache 2.4+ (XAMPP/WAMP/LAMP) |
| **Security** | MySQLi Prepared Statements, Input Sanitization |
| **Utilities** | Helper Functions, DateTime, Regular Expressions |

## 📁 Struktur Proyek

```
pendaftaran-rs/
├── app/
│   ├── controllers/          # Business logic layer
│   │   ├── PasienController.php
│   │   └── ResumeMedisController.php
│   ├── models/              # Data access layer
│   │   ├── Pasien.php
│   │   └── ResumeMedis.php
│   ├── helpers/             # Utility functions
│   │   └── Helper.php
│   └── views/               # User interface
│       ├── layouts/
│       ├── patient/
│       ├── medical/
│       └── dashboard/
├── config/
│   ├── database.php         # Database configuration & connection
│   └── constants.php        # App constants & enums
├── database/
│   └── db_pasien.sql        # Database schema & sample data
├── public/
│   ├── index.php            # Entry point
│   ├── css/
│   └── js/
├── .gitignore              # Git ignore rules
├── CONTRIBUTING.md         # Contribution guidelines
├── LICENSE                 # MIT License
├── README.md              # This file
└── GITHUB_PUSH_GUIDE.md   # GitHub setup guide
```

## 🚀 Instalasi

### Prerequisites
- **PHP** 7.4 atau lebih tinggi
- **MySQL** 5.7 atau MariaDB 10.2+
- **Apache** 2.4+ dengan mod_rewrite
- **Git** untuk version control
- **Text Editor** (VS Code, Sublime, dll)

### Step-by-Step Installation

#### 1. Download/Clone Repository
```bash
# Clone dari GitHub
git clone https://github.com/yourusername/pendaftaran-rs.git

# atau download ZIP dan extract ke folder htdocs
cd pendaftaran-rs
```

#### 2. Buat Database
```bash
# Login ke MySQL
mysql -u root -p

# Atau gunakan phpMyAdmin
# Buka: http://localhost/phpmyadmin
```

```sql
-- Create database
CREATE DATABASE db_pasien CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- Use database
USE db_pasien;

-- Import schema
SOURCE database/db_pasien.sql;
```

#### 3. Configure Database Connection
Edit file `config/database.php`:
```php
define('DB_HOST', 'localhost');
define('DB_USER', 'root');        // Ganti dengan username MySQL Anda
define('DB_PASS', '');             // Ganti dengan password MySQL Anda
define('DB_NAME', 'db_pasien');    // Nama database
```

#### 4. Setup File Permissions
```bash
# Windows (jika diperlukan)
# Set write permission untuk folders:
# - /app/views/
# - /uploads/ (jika ada)

# Linux/Mac
chmod 755 app/
chmod 755 public/
chmod 755 database/
```

#### 5. Start Web Server
```bash
# Menggunakan XAMPP
# - Start Apache & MySQL dari XAMPP Control Panel

# Menggunakan PHP Built-in Server
php -S localhost:8000

# Akses: http://localhost/pendaftaran-rs/public/
# atau: http://localhost:8000/
```

#### 6. Access Application
```
URL: http://localhost/pendaftaran-rs/public/
atau: http://localhost/pendaftaran-rs/
```

## 🗄️ Database Schema

### Tabel: `pasien`
Menyimpan informasi data pasien

| Field | Type | Deskripsi |
|-------|------|-----------|
| id_pasien | INT (Primary) | ID unik pasien |
| no_rm | VARCHAR(20) | Nomor Rekam Medis (auto-generated) |
| nik | VARCHAR(16) UNIQUE | Nomor Identitas Kependudukan |
| nama | VARCHAR(100) | Nama lengkap pasien |
| jenis_kelamin | CHAR(1) | L (Laki-laki) / P (Perempuan) |
| agama | VARCHAR(20) | Agama |
| tempat_lahir | VARCHAR(100) | Kota tempat lahir |
| tgl_lahir | DATE | Tanggal lahir |
| alamat | TEXT | Alamat lengkap |
| kota | VARCHAR(50) | Kota domisili |
| provinsi | VARCHAR(50) | Provinsi |
| kode_pos | VARCHAR(10) | Kode pos |
| no_hp | VARCHAR(15) | Nomor telepon |
| pekerjaan | VARCHAR(50) | Pekerjaan/Profesi |
| status_perkawinan | VARCHAR(20) | Status pernikahan |
| pendidikan | VARCHAR(20) | Riwayat pendidikan |
| created_at | TIMESTAMP | Tanggal dibuat |
| updated_at | TIMESTAMP | Tanggal update terakhir |

### Tabel: `resume_medis`
Menyimpan rekam medis (resume) setiap kunjungan pasien

| Field | Type | Deskripsi |
|-------|------|-----------|
| id_resume | INT (Primary) | ID unik resume medis |
| id_pasien | INT (Foreign) | FK ke tabel pasien |
| tanggal_kunjungan | DATE | Tanggal kunjungan |
| diagnosis | TEXT | Diagnosis medis |
| tindakan | TEXT | Tindakan/Perawatan |
| total_biaya | DECIMAL(12,2) | Biaya kunjungan |
| keterangan | TEXT | Catatan tambahan |
| created_at | TIMESTAMP | Tanggal dibuat |
| updated_at | TIMESTAMP | Tanggal update |

## 📚 API Reference

### Pasien Model

#### 1. getAll($limit, $offset)
Mendapatkan semua data pasien
```php
$pasienModel = new Pasien($conn);
$result = $pasienModel->getAll(10, 0); // Limit 10, offset 0
```

#### 2. getById($id)
Mendapatkan pasien berdasarkan ID
```php
$result = $pasienModel->getById(1);
$pasien = $result->fetch_assoc();
```

#### 3. getByNIK($nik)
Cari pasien berdasarkan NIK
```php
$result = $pasienModel->getByNIK('1234567890123456');
```

#### 4. getByNoRM($noRM)
Cari pasien berdasarkan No RM
```php
$result = $pasienModel->getByNoRM('RM00001');
```

#### 5. search($keyword, $limit, $offset)
Cari pasien dengan keyword
```php
$result = $pasienModel->search('Budi', 10, 0);
```

#### 6. insert($data)
Menambah pasien baru
```php
$data = [
    'no_rm' => 'RM00001',
    'nik' => '1234567890123456',
    'nama' => 'John Doe',
    'jenis_kelamin' => 'L',
    'agama' => 'Islam',
    'tempat_lahir' => 'Jakarta',
    'tgl_lahir' => '1990-01-15',
    'alamat' => 'Jl. Merdeka No. 123',
    'kota' => 'Jakarta',
    'provinsi' => 'Jakarta',
    'kode_pos' => '12345',
    'no_hp' => '081234567890',
    'pekerjaan' => 'Karyawan',
    'status_perkawinan' => 'Menikah',
    'pendidikan' => 'S1'
];
$success = $pasienModel->insert($data);
```

#### 7. update($id, $data)
Update data pasien
```php
$pasienModel->update(1, $data);
```

#### 8. delete($id)
Hapus pasien
```php
$pasienModel->delete(1);
```

### ResumeMedis Model

#### 1. getAll($limit, $offset)
Mendapatkan semua resume medis
```php
$resumeModel = new ResumeMedis($conn);
$result = $resumeModel->getAll(10, 0);
```

#### 2. getByPasienId($pasienId, $limit, $offset)
Mendapatkan resume medis pasien tertentu
```php
$result = $resumeModel->getByPasienId(1, 5, 0);
```

#### 3. countByPasien($pasienId)
Hitung jumlah kunjungan pasien
```php
$count = $resumeModel->countByPasien(1);
```

#### 4. getTotalCostByPasien($pasienId)
Hitung total biaya pasien
```php
$total = $resumeModel->getTotalCostByPasien(1);
echo formatCurrency($total);
```

#### 5. insert($data)
Menambah resume medis baru
```php
$data = [
    'id_pasien' => 1,
    'tanggal_kunjungan' => '2024-01-15',
    'diagnosis' => 'Demam tinggi',
    'tindakan' => 'Konsultasi & pemberian obat',
    'total_biaya' => 150000,
    'keterangan' => 'Pasien disarankan istirahat'
];
$resumeModel->insert($data);
```

## 🎨 Helper Functions

### Formatting
```php
formatDate($date)                    // Format tanggal: 15-01-2024
formatDateTime($datetime)            // Format datetime: 15-01-2024 14:30:00
formatCurrency($value)               // Format uang: Rp 1.500.000
formatPhone($phone)                  // Format telp: 62-1234-567890
```

### Validation
```php
isValidNIK($nik)                    // Validasi NIK (16 digit)
isValidPhoneNumber($phone)          // Validasi No HP
isValidEmail($email)                // Validasi email
isValidDate($date, $format)         // Validasi tanggal
isValidAge($age)                    // Validasi umur
```

### Text Conversion
```php
getGenderText('L')                  // Laki-laki
getReligionText('Islam')            // Islam
getEducationText('S1')              // S1
getOccupationText('Karyawan')       // Karyawan
getMaritalStatusText('Menikah')     // Menikah
```

### Request Handling
```php
getQuery('search')                  // $_GET['search']
getPost('nama')                     // $_POST['nama']
getRequest('action')                // $_POST atau $_GET['action']
isPost()                            // Check POST request
isGet()                             // Check GET request
isAjax()                            // Check AJAX request
```

### Security
```php
sanitize($input)                    // Escape HTML & remove dangerous chars
generateToken($length)              // Generate random token
hashPassword($password)             // Hash password dengan bcrypt
verifyPassword($plain, $hash)       // Verify password
```

### Utilities
```php
calculateAge($birthDate)            // Hitung umur dari tgl lahir
redirect($url)                      // Redirect ke URL
jsonResponse($success, $msg, $data) // Return JSON response
getCurrentDate()                    // Tanggal hari ini: Y-m-d
getCurrentDateTime()                // Datetime sekarang
limitString($str, 50)               // Batasi panjang string
createSlug($str)                    // Convert string ke slug
generateUUID()                      // Generate UUID v4
```

## 👨‍💻 Contribution Guide

Kami menerima kontribusi dari komunitas! Silakan baca [CONTRIBUTING.md](CONTRIBUTING.md) untuk detail.

### Quick Contribution Steps
1. Fork repository
2. Buat feature branch: `git checkout -b feature/YourFeature`
3. Commit changes: `git commit -m "Add YourFeature"`
4. Push ke branch: `git push origin feature/YourFeature`
5. Open Pull Request

## 📝 License

Project ini dilisensikan di bawah [MIT License](LICENSE) - bebas digunakan untuk keperluan komersial maupun non-komersial.

## 📞 Support

Jika ada pertanyaan atau issues:
1. Buka [GitHub Issues](https://github.com/yourusername/pendaftaran-rs/issues)
2. Jelaskan masalah secara detail dengan screenshot jika perlu
3. Tunggu response dari team

## 🙏 Credits

- **Esa Unggul Hospital IT Team**
- **Contributors & Community**

## 📋 Changelog

### v1.0.0 (Current)
- ✅ Initial release
- ✅ Pasien management (CRUD)
- ✅ Resume medis management
- ✅ Search & filter functionality
- ✅ Helper functions
- ✅ GitHub documentation

---

**Terima kasih telah menggunakan Pendaftaran RS!** 🏥

Untuk update terbaru, ikuti repository kami di GitHub.

Made with ❤️ by Esa Unggul Hospital IT Team
