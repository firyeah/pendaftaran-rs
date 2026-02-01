# Setup & Deployment Guide - Pendaftaran RS

Panduan lengkap untuk setup, testing, dan deployment aplikasi Pendaftaran RS.

## Prerequisites

- PHP 7.4 or higher
- MySQL 5.7 or higher
- Apache 2.4 or higher (via XAMPP)
- Composer (optional, for package management)

## Installation Steps

### 1. Database Setup

1. **Open phpMyAdmin**
   - Go to `http://localhost/phpmyadmin/`
   - Login dengan default credentials (biasanya root:empty password)

2. **Import Database Schema**
   - Click "Databases" → Create new database
   - Database name: `db_pasien`
   - Collation: `utf8mb4_general_ci`
   - Click "Create"
   - Go to new `db_pasien` database
   - Click "Import" tab
   - Choose file: `db_pasien.sql`
   - Click "Import"

3. **Verify Tables**
   - You should see 2 tables:
     - `pasien` (18 columns) - Patient data
     - `resume_medis` (8 columns) - Medical records

### 2. Application Setup

1. **Place Files in Web Root**
   ```
   XAMPP: c:\xampp\htdocs\pendaftaran-rs\
   OR
   OneDrive: c:\Users\Firyal\OneDrive\ドキュメント\SEMESTER GANJIL\perancangan\UAS\sistem\pendaftaran-rs\
   ```

2. **Check Configuration Files**
   - Open `config/database.php`
   - Verify database credentials:
     - `DB_HOST = 'localhost'`
     - `DB_USER = 'root'`
     - `DB_PASS = ''` (empty for default XAMPP)
     - `DB_NAME = 'db_pasien'`

3. **Check Constants File**
   - Open `config/constants.php`
   - Verify `BASE_URL` points to your installation directory
   - Example: `http://localhost/pendaftaran-rs/public/`

### 3. Start Application

1. **Start XAMPP**
   - Open XAMPP Control Panel
   - Start Apache
   - Start MySQL

2. **Access Application**
   - Open browser: `http://localhost/pendaftaran-rs/public/`
   - You should see the Patient List page
   - Default database includes 5 sample patients

## File Structure

```
pendaftaran-rs/
├── app/
│   ├── controllers/
│   │   ├── PasienController.php (Patient management)
│   │   └── ResumeMedisController.php (Medical records)
│   ├── models/
│   │   ├── Pasien.php
│   │   ├── ResumeMedis.php
│   │   └── Model.php (Base class)
│   ├── helpers/
│   │   └── Helper.php (40+ utility functions)
│   └── views/
│       ├── layouts/
│       │   ├── header.php (Navigation & messages)
│       │   └── footer.php (Footer & scripts)
│       ├── patient/
│       │   ├── index.php (List patients)
│       │   ├── add.php (New patient form)
│       │   ├── edit.php (Edit patient form)
│       │   ├── view.php (Patient details)
│       │   └── search.php (Search results)
│       └── medical/
│           ├── index.php (List medical records)
│           ├── create.php (New record form)
│           ├── edit.php (Edit record form)
│           ├── view.php (Record details)
│           └── by-patient.php (Patient's records)
├── config/
│   ├── database.php (Database connection)
│   ├── constants.php (App constants & enums)
│   └── settings.php (App settings)
├── database/
│   └── db_pasien.sql (Database schema)
├── public/
│   └── index.php (Router/Entry point)
└── run-server.bat (Windows batch script to start server)
```

## Features

### Patient Management
- ✅ Create new patient registration
- ✅ View patient details & medical history
- ✅ Edit patient information
- ✅ Delete patient records
- ✅ Search patients by name, NIK, or RM
- ✅ Pagination support

### Medical Records
- ✅ Create medical visit records
- ✅ View medical record details
- ✅ Edit medical records
- ✅ Delete medical records
- ✅ Filter by patient
- ✅ Cost tracking & statistics

## Testing Procedures

### 1. Manual Testing - Patient Management

1. **Add New Patient**
   - Click "Tambah Pasien" on patient list
   - Fill all required fields:
     - NIK (16 digits)
     - Name
     - Gender
     - Birth date
     - Contact info
   - Click "Simpan"
   - Verify success message
   - Verify patient appears in list

2. **View Patient Details**
   - Click patient name or "Lihat" button
   - Verify all details display correctly
   - Check medical history section

3. **Edit Patient**
   - Click "Edit" button on patient detail
   - Modify any field
   - Click "Simpan Perubahan"
   - Verify changes saved

4. **Search Patients**
   - Use search bar on patient list
   - Search by name, NIK, or RM
   - Verify results display correctly

5. **Delete Patient** (optional)
   - Click "Hapus" button
   - Confirm deletion
   - Verify patient removed from list

### 2. Manual Testing - Medical Records

1. **Add Medical Record**
   - Click "Tambah Catatan" or use Medical Records page
   - Select patient from dropdown
   - Fill:
     - Visit date/time
     - Diagnosis
     - Medical actions
     - Cost
   - Click "Simpan"
   - Verify success message

2. **View Medical Record**
   - Click "Lihat" on medical record
   - Verify all details display
   - Check patient name and RM link

3. **Edit Medical Record**
   - Click "Edit" button
   - Modify any field
   - Click "Simpan Perubahan"
   - Verify changes saved

4. **View Patient Medical History**
   - Go to patient detail
   - Scroll to "Catatan Medis" section
   - Click "Lihat Semua" or patient name link
   - Verify all patient's medical records display

### 3. Database Verification

```sql
-- Check patient count
SELECT COUNT(*) as total_pasien FROM pasien;

-- Check medical records count
SELECT COUNT(*) as total_catatan FROM resume_medis;

-- Verify latest records
SELECT * FROM pasien ORDER BY id DESC LIMIT 5;
SELECT * FROM resume_medis ORDER BY id DESC LIMIT 5;

-- Check duplicate NIK
SELECT nik, COUNT(*) FROM pasien GROUP BY nik HAVING COUNT(*) > 1;
```

## Common Issues & Solutions

### Issue 1: "Database connection failed"
**Solution:**
- Start MySQL service in XAMPP
- Verify credentials in `config/database.php`
- Check if database `db_pasien` exists

### Issue 2: "404 Error - Controller not found"
**Solution:**
- Verify URL format: `/patient`, `/medical`
- Check controller file names are correct
- Verify public/index.php router is working

### Issue 3: "Form not submitting"
**Solution:**
- Check browser console for JavaScript errors
- Verify form action URL is correct
- Check $_POST data is being sent

### Issue 4: "Characters encoding issue (特殊文字がおかしい)"
**Solution:**
- Verify database collation: `utf8mb4_general_ci`
- Check HTML charset: `<meta charset="utf-8">`
- Verify PHP header: `header('Content-Type: text/html; charset=utf-8');`

## Performance Optimization

### For Small Database (< 10,000 records)
- Current setup is sufficient
- Pagination handles 20 records per page

### For Large Database (> 10,000 records)
- Add database indexes on frequently searched columns (NIK, nama)
- Implement search caching
- Add database query optimization

### Recommended Indexes
```sql
ALTER TABLE pasien ADD INDEX idx_nik (nik);
ALTER TABLE pasien ADD INDEX idx_nama (nama);
ALTER TABLE resume_medis ADD INDEX idx_pasien_id (pasien_id);
```

## Deployment Checklist

- [ ] Database imported successfully
- [ ] All files in correct directory
- [ ] config/database.php updated with correct credentials
- [ ] config/constants.php BASE_URL is correct
- [ ] Apache & MySQL services running
- [ ] Can access application at public/index.php
- [ ] Patient list displays with sample data
- [ ] Can create new patient
- [ ] Can add medical record
- [ ] Search functionality works
- [ ] Pagination works correctly

## Next Steps - GitHub Push

1. **Initialize Git Repository**
   ```bash
   cd pendaftaran-rs
   git init
   git config user.name "Your Name"
   git config user.email "your.email@example.com"
   ```

2. **Stage All Files**
   ```bash
   git add .
   ```

3. **Create Initial Commit**
   ```bash
   git commit -m "Initial commit: Pendaftaran RS MVC refactor complete"
   ```

4. **Add Remote Repository**
   ```bash
   git remote add origin https://github.com/yourusername/pendaftaran-rs.git
   ```

5. **Push to GitHub**
   ```bash
   git branch -M main
   git push -u origin main
   ```

## Support & Documentation

- API Reference: See [API_REFERENCE.md](../API_REFERENCE.md)
- Contributing: See [CONTRIBUTING.md](CONTRIBUTING.md)
- Project Summary: See [PROJECT_SUMMARY.md](PROJECT_SUMMARY.md)

---

**Version:** 1.0.0  
**Last Updated:** December 2025  
**Status:** Production Ready ✅
