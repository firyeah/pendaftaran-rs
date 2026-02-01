# CONTRIBUTING - Panduan Kontribusi

Terima kasih telah tertarik berkontribusi pada Pendaftaran RS! Dokumentasi ini akan memandu Anda melalui proses kontribusi.

## 📋 Code of Conduct

- Hormati semua kontributor
- Berikan feedback yang konstruktif dan membantu
- Laporkan bug dengan detail dan jelas
- Diskusikan ide besar sebelum membuat PR yang besar
- Hindari spamming atau pesan yang tidak konstruktif

## 🐛 Reporting Bugs

Sebelum membuat issue, pastikan:
1. Bug belum dilaporkan di [Issues](https://github.com/yourusername/pendaftaran-rs/issues)
2. Anda menggunakan versi terbaru dari kode

### Format Laporan Bug

```markdown
## Deskripsi Bug
Jelaskan bug secara singkat dan jelas

## Langkah untuk Mereproduksi
1. Pergi ke '...'
2. Klik '...'
3. Masukkan '...'
4. Lihat error '...'

## Expected Behavior
Apa yang seharusnya terjadi

## Actual Behavior
Apa yang benar-benar terjadi

## Environment
- OS: Windows 10 / Ubuntu 20.04 / macOS
- PHP Version: 7.4 / 8.0 / 8.1
- MySQL Version: 5.7 / 8.0

## Screenshots
[Jika ada, sertakan screenshot]

## Logs
[Jika ada, sertakan error log]
```

## 💡 Suggesting Enhancements

### Format Suggestion

```markdown
## Deskripsi Enhancement
Jelaskan fitur baru secara singkat

## Use Case
Mengapa fitur ini penting/berguna?

## Implementasi yang Mungkin
Bagaimana cara mengimplementasikannya?

## Alternative Solutions
Solusi alternatif apa yang sudah dipertimbangkan?
```

## 🔨 Development Setup

### Prerequisites
- Git
- PHP 7.4+
- MySQL 5.7+
- XAMPP / Local server
- Text editor (VS Code, Sublime, etc)

### Local Development

#### 1. Fork & Clone
```bash
# Fork repository (di GitHub UI)

# Clone fork Anda
git clone https://github.com/your-username/pendaftaran-rs.git
cd pendaftaran-rs

# Tambahkan upstream
git remote add upstream https://github.com/original/pendaftaran-rs.git
```

#### 2. Create Feature Branch
```bash
# Update main branch
git checkout main
git pull upstream main

# Create feature branch
git checkout -b feature/YourFeatureName
# atau untuk bug fix
git checkout -b bugfix/BugDescription
```

#### 3. Setup Database
```bash
# Create database
mysql -u root -p < database/db_pasien.sql
```

#### 4. Konfigurasi Environment
```bash
# Copy config template jika ada
cp config/database.php.example config/database.php

# Edit config dengan setting lokal Anda
# - DB_HOST, DB_USER, DB_PASS
```

#### 5. Make Changes
- Buat perubahan di feature branch
- Test perubahan secara menyeluruh
- Follow code style guidelines

## 📝 Coding Standards

### PHP Style Guide

Follow PSR-12 Standard:

```php
<?php
// Class definition
class PasienController {
    // Properties
    private $model;
    private $database;
    
    /**
     * Constructor dengan dokumentasi
     */
    public function __construct($db) {
        $this->model = new Pasien($db);
        $this->database = $db;
    }
    
    // Public methods
    public function viewPatient($id) {
        // Implementation
    }
    
    // Private methods
    private function validateInput($data) {
        // Implementation
    }
}
```

### Naming Conventions
- **Classes**: `PascalCase` (e.g., `PasienController`, `ResumeMedis`)
- **Methods**: `camelCase` (e.g., `getPatient()`, `validateInput()`)
- **Variables**: `camelCase` (e.g., `$patientId`, `$firstName`)
- **Constants**: `UPPER_SNAKE_CASE` (e.g., `DB_HOST`, `MAX_UPLOAD_SIZE`)
- **Functions**: `camelCase` (e.g., `sanitize()`, `formatDate()`)

### Security Requirements

✅ **MUST DO:**
- Use prepared statements untuk semua database queries
- Sanitize semua input dengan `sanitize()` function
- Validate semua form data sebelum processing
- Escape output dengan `htmlspecialchars()`
- Check data type dan range
- Use existing helper functions

❌ **DO NOT:**
- Direct string concatenation di SQL queries
- Trust user input tanpa validasi
- Output user data tanpa escaping
- Hardcode database credentials
- Commit sensitive data (passwords, keys)

### Comment Standards

```php
/**
 * Deskripsi method yang jelas
 * 
 * @param int $id Patient ID
 * @param string $name Patient name
 * @return bool Success status
 * @throws Exception Jika ada error
 */
public function updatePatient($id, $name) {
    // Implementation
}

// Single line comment untuk logika kompleks
$nextNo = ($lastNo ?? 0) + 1; // Increment dengan default 0
```

## 🧪 Testing

Sebelum submit PR, pastikan:

### Manual Testing
1. ✅ Test CRUD operations untuk setiap entity
2. ✅ Test dengan invalid/edge case input
3. ✅ Test search & filter functionality
4. ✅ Test di berbagai browser (Chrome, Firefox, Edge)
5. ✅ Test di mobile/responsive design

### Security Testing
- ✅ SQL Injection: Coba `' OR '1'='1`
- ✅ XSS: Coba `<script>alert('XSS')</script>`
- ✅ Input validation: Coba data type yang salah
- ✅ File upload: Coba file berbahaya

### Browser Compatibility
- ✅ Chrome (latest)
- ✅ Firefox (latest)
- ✅ Safari (latest)
- ✅ Edge (latest)

## 📤 Submitting a Pull Request

### 1. Commit Changes
```bash
# Add files
git add .

# Commit dengan pesan yang deskriptif
git commit -m "feat: add patient search by NIK"
# atau
git commit -m "fix: prevent duplicate patient registration"
```

### Commit Message Format
```
<type>: <subject>

<body>

<footer>
```

**Types:**
- `feat`: Feature baru
- `fix`: Bug fix
- `docs`: Documentation changes
- `style`: Code style changes (formatting, missing semicolons)
- `refactor`: Code refactoring tanpa feature/fix
- `perf`: Performance improvement
- `test`: Testing related
- `chore`: Build, deps, tooling

**Examples:**
```
feat: add patient search by NIK

- Implement search functionality in PasienController
- Add search view with filter options
- Update database query for better performance

Closes #123

---

fix: prevent duplicate patient registration

Check if patient already exists before creating new entry

Fixes #456

---

docs: update API documentation

Add missing method descriptions in README

---

refactor: improve database query efficiency

Reduce number of queries from 3 to 1 for patient listing
```

### 2. Push ke Fork
```bash
git push origin feature/YourFeatureName
```

### 3. Create Pull Request

Di GitHub:
1. Klik "Compare & pull request"
2. Set base branch ke `main`
3. Isi PR template dengan detail:

```markdown
## Deskripsi
Brief description of the changes

## Related Issues
Closes #123

## Type of Change
- [x] Bug fix (non-breaking change which fixes an issue)
- [ ] New feature (non-breaking change which adds functionality)
- [ ] Breaking change (fix or feature that would cause existing functionality to change)
- [ ] Documentation update

## Testing Done
- [x] Tested CRUD operations
- [x] Tested search functionality
- [x] Tested with invalid input
- [x] Tested in multiple browsers
- [x] No console errors or warnings

## Checklist
- [x] Code follows the style guidelines
- [x] Self-review of own code done
- [x] Comments added for complex logic
- [x] Documentation updated
- [x] No new warnings generated
- [x] Tests added/updated
- [x] Dependencies added/removed if needed
- [x] No breaking changes
- [x] Security review done
```

### 4. PR Review Process

- **Maintainer akan review** PR Anda
- **Feedback akan diberikan** jika diperlukan changes
- **Iterasi** sampai semua puas
- **Merge** setelah approval

## ✅ Checklist Sebelum Submit PR

```
[ ] Branch dibuat dari latest main
[ ] Code ditest secara manual
[ ] Security review dilakukan
[ ] Commit message mengikuti format
[ ] No console errors/warnings
[ ] Code style konsisten
[ ] Dokumentasi updated
[ ] PR description jelas dan detail
[ ] Tidak ada conflict dengan main branch
[ ] All tests pass (jika ada)
```

## 📚 Additional Resources

- [GitHub Help - Creating a Pull Request](https://docs.github.com/en/pull-requests/collaborating-with-pull-requests/proposing-changes-to-your-work-with-pull-requests/creating-a-pull-request)
- [Commit Message Conventions](https://www.conventionalcommits.org/)
- [PHP-FIG PSR-12 Coding Standard](https://www.php-fig.org/psr/psr-12/)
- [OWASP Top 10 Security Issues](https://owasp.org/www-project-top-ten/)

## 🎯 General Guidelines

1. **One feature per PR** - Jangan mix multiple features di satu PR
2. **Keep it small** - Smaller PRs are easier to review
3. **Communicate** - Discuss major changes dalam issue dulu
4. **Be patient** - Review membutuhkan waktu, jangan push tanpa alasan
5. **Respect decisions** - Jika PR ditolak, pahami alasannya dan diskusikan

## 🙏 Thank You!

Terima kasih telah berkontribusi pada Pendaftaran RS! Kontribusi Anda sangat dihargai dan membantu project ini terus berkembang. 

Jika ada pertanyaan, jangan ragu untuk menghubungi maintainers atau buka discussion di GitHub.

---

**Happy Contributing!** 🚀
