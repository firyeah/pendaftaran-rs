# 🚀 QUICK_START.md - Panduan Cepat Mulai

Mulai dengan **Pendaftaran RS** dalam 5 menit!

## ⚡ Quick Setup (5 Minutes)

### 1️⃣ Prerequisites Check
```bash
# Check PHP version
php -v  # Should be 7.4 or higher

# Check MySQL running
mysql -u root -p  # atau phpMyAdmin
```

### 2️⃣ Create Database
```sql
-- MySQL/phpMyAdmin
CREATE DATABASE db_pasien CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- Import schema
USE db_pasien;
SOURCE database/db_pasien.sql;
```

### 3️⃣ Configure Connection
Edit `config/database.php`:
```php
define('DB_HOST', 'localhost');   // Usually localhost
define('DB_USER', 'root');        // Your MySQL username
define('DB_PASS', '');             // Your MySQL password (empty for local)
define('DB_NAME', 'db_pasien');
```

### 4️⃣ Start Server
```bash
# Option 1: XAMPP
# - Start Apache & MySQL from XAMPP Control Panel
# - Access: http://localhost/pendaftaran-rs/

# Option 2: Built-in PHP Server
php -S localhost:8000
# Access: http://localhost:8000/
```

### 5️⃣ Access Application
```
http://localhost/pendaftaran-rs/
```

✅ **Done!** Your application is running!

---

## 📚 Usage Examples

### List All Patients
```
URL: http://localhost/pendaftaran-rs/data_pasien.php
Shows: Table of all registered patients
```

### Register New Patient
```
URL: http://localhost/pendaftaran-rs/daftar_pasien.php
Form: Fill patient information and submit
```

### Search Patient
```
URL: http://localhost/pendaftaran-rs/data_pasien.php
Use: Search box (by name, NIK, or RM number)
```

### View Medical Records
```
URL: http://localhost/pendaftaran-rs/resume_medis.php
Shows: All medical visit records
```

---

## 🔧 Using Models Programmatically

### Example 1: Get All Patients
```php
<?php
require 'config/database.php';
require 'config/constants.php';
require 'app/models/Pasien.php';
require 'app/helpers/Helper.php';

$db = new Database();
$conn = $db->getConnection();
$pasienModel = new Pasien($conn);

$result = $pasienModel->getAll(10, 0);
while ($pasien = $result->fetch_assoc()) {
    echo $pasien['nama'] . " - " . $pasien['nik'];
}
```

### Example 2: Add New Patient
```php
<?php
// ... require files ...

$pasienModel = new Pasien($conn);

$noRM = $pasienModel->getNextNoRM();
$data = [
    'no_rm' => $noRM,
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

if ($pasienModel->insert($data)) {
    echo "Patient added successfully!";
} else {
    echo "Error adding patient";
}
```

### Example 3: Search Patients
```php
<?php
// ... require files ...

$pasienModel = new Pasien($conn);
$keyword = 'Budi';
$result = $pasienModel->search($keyword, 10, 0);

while ($pasien = $result->fetch_assoc()) {
    echo $pasien['nama'] . " (" . $pasien['no_rm'] . ")<br>";
}
```

### Example 4: Get Medical Records by Patient
```php
<?php
// ... require files ...

$resumeModel = new ResumeMedis($conn);
$pasienId = 1;

$result = $resumeModel->getByPasienId($pasienId, 5, 0);
while ($record = $result->fetch_assoc()) {
    echo formatDate($record['tanggal_kunjungan']) . " - ";
    echo $record['diagnosis'] . " - ";
    echo formatCurrency($record['total_biaya']) . "<br>";
}
```

---

## 📝 Using Helper Functions

### Formatting Functions
```php
// Date formatting
$date = formatDate('2024-01-15');  // Output: 15-01-2024
$datetime = formatDateTime('2024-01-15 14:30:00');  // 15-01-2024 14:30:00
$currency = formatCurrency(150000);  // Rp 150.000

// Text conversion
$gender = getGenderText('L');  // Laki-laki
$religion = getReligionText('Islam');  // Islam
$job = getOccupationText('Karyawan');  // Karyawan
```

### Validation Functions
```php
// Validate input
if (isValidNIK('1234567890123456')) {
    // Valid NIK format
}

if (isValidPhoneNumber('081234567890')) {
    // Valid phone number
}

$age = calculateAge('1990-01-15');
if (isValidAge($age)) {
    // Age is valid (0-150)
}
```

### Security Functions
```php
// Sanitize user input
$name = sanitize($_POST['nama']);
$email = sanitize($_POST['email']);

// Validate email
if (isValidEmail($email)) {
    // Email is valid
}

// Generate random token
$token = generateToken(32);

// Hash password (if needed)
$hashed = hashPassword('mypassword');
if (verifyPassword('mypassword', $hashed)) {
    // Password matches
}
```

### Request Handling
```php
// Get parameters safely
$search = getQuery('search');  // From GET
$action = getPost('action');   // From POST
$id = getRequest('id');        // From GET or POST

// Check request method
if (isPost()) {
    // Handle POST request
}

if (isGet()) {
    // Handle GET request
}

// Check AJAX
if (isAjax()) {
    // Handle AJAX request
    jsonResponse(true, 'Success', $data);
}
```

---

## 🗄️ Database Schema Quick Reference

### pasien Table
```
id_pasien (INT, Primary Key)
no_rm (VARCHAR, Auto-generated)
nik (VARCHAR, Unique)
nama (VARCHAR)
jenis_kelamin (CHAR: L/P)
agama (VARCHAR)
tempat_lahir (VARCHAR)
tgl_lahir (DATE)
alamat (TEXT)
kota (VARCHAR)
provinsi (VARCHAR)
kode_pos (VARCHAR)
no_hp (VARCHAR)
pekerjaan (VARCHAR)
status_perkawinan (VARCHAR)
pendidikan (VARCHAR)
created_at (TIMESTAMP)
updated_at (TIMESTAMP)
```

### resume_medis Table
```
id_resume (INT, Primary Key)
id_pasien (INT, Foreign Key)
tanggal_kunjungan (DATE)
diagnosis (TEXT)
tindakan (TEXT)
total_biaya (DECIMAL)
keterangan (TEXT)
created_at (TIMESTAMP)
updated_at (TIMESTAMP)
```

---

## 🆘 Troubleshooting

### Issue: Database connection failed
```
Solution: 
1. Check MySQL is running
2. Verify credentials in config/database.php
3. Ensure database exists: db_pasien
```

### Issue: Page shows blank
```
Solution:
1. Check PHP error logs
2. Enable DEBUG_MODE in config/constants.php
3. Check if model files are loaded
```

### Issue: Data not saving
```
Solution:
1. Verify database connection
2. Check INSERT query in model
3. Validate form data before insert
4. Check file permissions on database folder
```

### Issue: Search not working
```
Solution:
1. Check search form is submitting POST/GET
2. Verify search input is not empty
3. Check SQL query in model search method
4. Verify database table exists
```

---

## 📖 Documentation Links

- **Full Documentation**: [README.md](README.md)
- **Contribution Guide**: [CONTRIBUTING.md](CONTRIBUTING.md)
- **GitHub Push Guide**: [GITHUB_PUSH_GUIDE.md](GITHUB_PUSH_GUIDE.md)
- **Refactor Plan**: [REFACTOR_PLAN.txt](REFACTOR_PLAN.txt)
- **License**: [LICENSE](LICENSE)

---

## 🎯 Next Steps

1. ✅ Setup database
2. ✅ Configure connection
3. ✅ Start server
4. ✅ Access application
5. 📖 Read full documentation
6. 🔨 Explore code structure
7. 💡 Start customizing

---

## 💡 Tips

- Always sanitize user input using `sanitize()` function
- Use prepared statements for database queries
- Test in multiple browsers
- Keep backups of your database
- Read the CONTRIBUTING guide before modifying

---

**Happy Coding!** 🎉

For detailed documentation, see [README.md](README.md)

For issues/support, open an issue on GitHub
