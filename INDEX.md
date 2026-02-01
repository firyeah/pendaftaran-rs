# 📑 INDEX - Daftar File Pendaftaran RS

> 🎯 **Panduan Lengkap Navigasi Project**

---

## 🚀 Mulai Di Sini

**Pertama kali?** Baca dalam urutan ini:

1. 👉 **[QUICK_START.md](QUICK_START.md)** - Mulai dalam 5 menit
2. 📖 **[README.md](README.md)** - Dokumentasi lengkap
3. 🛠️ **[GITHUB_PUSH_GUIDE.md](GITHUB_PUSH_GUIDE.md)** - Push ke GitHub
4. 📚 **[CONTRIBUTING.md](CONTRIBUTING.md)** - Berkontribusi

---

## 📚 Dokumentasi Lengkap

### 📖 Main Documentation
| File | Deskripsi | Target |
|------|-----------|--------|
| **[README.md](README.md)** | Dokumentasi lengkap project | Semua |
| **[QUICK_START.md](QUICK_START.md)** | Setup cepat dalam 5 menit | Beginner |
| **[PROJECT_SUMMARY.md](PROJECT_SUMMARY.md)** | Ringkasan project & statistik | Overview |

### 🔧 Development Guides
| File | Deskripsi | Target |
|------|-----------|--------|
| **[CONTRIBUTING.md](CONTRIBUTING.md)** | Panduan berkontribusi & coding standards | Developer |
| **[GITHUB_PUSH_GUIDE.md](GITHUB_PUSH_GUIDE.md)** | Setup & push ke GitHub | Beginner |
| **[REFACTOR_PLAN.txt](REFACTOR_PLAN.txt)** | Roadmap & fase refactoring | Developer |

### 📄 Configuration
| File | Deskripsi | Target |
|------|-----------|--------|
| **[LICENSE](LICENSE)** | MIT License | Legal |
| **[.gitignore](.gitignore)** | Git ignore rules | Git |

---

## 💻 Code Files

### 🎯 Config Layer
```
config/
├── database.php         Database connection & utilities class
└── constants.php        App constants, enums, paths, settings
```

**Mulai dari sini untuk:**
- Setup database connection
- Memahami app constants
- Konfigurasi app

### 📊 Models Layer (Data Access)
```
app/models/
├── Pasien.php           Patient data management (11 methods)
│   └── Methods: getAll, getById, search, insert, update, delete, etc
│
└── ResumeMedis.php      Medical records management (8 methods)
    └── Methods: getAll, getById, getByPasienId, insert, update, delete, etc
```

**Gunakan ini untuk:**
- Database operations
- CRUD operations
- Query building
- Data retrieval

### 🛠️ Helpers Layer (Utilities)
```
app/helpers/
└── Helper.php           40+ utility functions
    ├── Formatting functions (formatDate, formatCurrency, etc)
    ├── Validation functions (isValidNIK, isValidEmail, etc)
    ├── Text conversion (getGenderText, getReligionText, etc)
    ├── Request handling (getQuery, getPost, isPost, etc)
    ├── Security functions (sanitize, hashPassword, etc)
    └── Utility functions (calculateAge, redirect, etc)
```

**Gunakan ini untuk:**
- Format data display
- Validate user input
- Safe database operations
- Common operations

### 🎮 Controllers Layer (Business Logic) ⏳
```
app/controllers/          [COMING SOON - Phase 2]
├── PasienController.php
│   └── Methods: index, add, store, view, edit, update, delete, search
│
└── ResumeMedisController.php
    └── Methods: index, create, store, edit, update, delete, byPatient
```

**Akan dibuat untuk:**
- Handle HTTP requests
- Orchestrate models & views
- Business logic
- Request validation

### 🎨 Views Layer (UI) ⏳
```
app/views/                [TO BE REFACTORED - Phase 3]
├── 📁 layouts/
│   ├── header.php
│   ├── footer.php
│   └── main.php
│
├── 📁 patient/
│   ├── index.php        (listing)
│   ├── add.php          (form)
│   ├── edit.php         (form)
│   └── view.php         (detail)
│
└── 📁 medical/
    ├── index.php        (listing)
    ├── create.php       (form)
    └── view.php         (detail)
```

**Untuk:**
- Display data to users
- Handle user input
- UI/UX elements

### 🌐 Public Entry Point ⏳
```
public/
└── index.php            [TO BE CREATED - Phase 4]
    ├── Load config & constants
    ├── Load database connection
    ├── Route dispatcher
    └── Controller execution
```

**Main entry point untuk:**
- All HTTP requests
- Routing to controllers
- Error handling

### 🗄️ Database
```
database/
└── db_pasien.sql        Database schema & sample data
    ├── Table: pasien (18 columns)
    └── Table: resume_medis (8 columns)
```

**Gunakan untuk:**
- Create database
- Import schema
- Sample data

---

## 📋 Original Files (Preserved)

Dari aplikasi asli yang tetap dipertahankan:

```
Root Directory:
├── index.php            Dashboard (procedural version)
├── daftar_pasien.php    Patient registration form
├── data_pasien.php      Patient listing
├── edit_pasien.php      Patient edit form
├── hapus_pasien.php     Patient deletion
├── resume_medis.php     Medical records
├── koneksi.php          Original database connection
└── db_pasien.sql        Database schema
```

**Status**: Preserved untuk backward compatibility
**Role**: Reference untuk understanding original logic

---

## 🎓 How to Use This Project

### Scenario 1: "Saya ingin setup cepat"
```
1. Baca: QUICK_START.md
2. Setup database: database/db_pasien.sql
3. Configure: config/database.php
4. Run & test dengan original files (index.php, etc)
```

### Scenario 2: "Saya ingin memahami struktur"
```
1. Baca: README.md
2. Explore: config/ (database.php, constants.php)
3. Explore: app/models/ (Pasien.php, ResumeMedis.php)
4. Explore: app/helpers/ (Helper.php)
5. Lihat: REFACTOR_PLAN.txt
```

### Scenario 3: "Saya ingin berkontribusi"
```
1. Baca: CONTRIBUTING.md
2. Setup development environment
3. Create feature branch: git checkout -b feature/name
4. Implement features mengikuti guidelines
5. Submit PR dengan deskripsi jelas
```

### Scenario 4: "Saya ingin push ke GitHub"
```
1. Baca: GITHUB_PUSH_GUIDE.md (step by step)
2. Create GitHub repository
3. Follow push commands
4. Verify di GitHub
```

### Scenario 5: "Saya ingin menggunakan models"
```
1. Baca: README.md → API Reference
2. Lihat contoh di: QUICK_START.md
3. Study: app/models/Pasien.php & ResumeMedis.php
4. Gunakan methods sesuai kebutuhan
```

---

## 📊 File Statistics

### Code Quality
- **Total PHP Code**: 1,280 lines ✅
- **Total Documentation**: 2,400+ lines ✅
- **Security**: Prepared statements + Validation ✅
- **Comments**: Well documented ✅

### Coverage
- **Database Models**: 100% ✅
- **Helper Functions**: 40+ functions ✅
- **Configuration**: Centralized ✅
- **Documentation**: Comprehensive ✅

### Missing (Will Be Added)
- Controllers: To be created (Phase 2)
- Views: To be refactored (Phase 3)
- Entry point: To be created (Phase 4)
- Testing: To be implemented (Phase 5)

---

## 🔍 Quick Reference

### When You Need...

**Database Setup**
→ See: [database/db_pasien.sql](database/db_pasien.sql)

**Configuration Help**
→ See: [config/database.php](config/database.php) & [config/constants.php](config/constants.php)

**How to Query Data**
→ See: [app/models/Pasien.php](app/models/Pasien.php) & [QUICK_START.md](QUICK_START.md)

**Helper Functions**
→ See: [app/helpers/Helper.php](app/helpers/Helper.php) & [README.md](README.md#-helper-functions)

**Contribution Guidelines**
→ See: [CONTRIBUTING.md](CONTRIBUTING.md)

**GitHub Push Instructions**
→ See: [GITHUB_PUSH_GUIDE.md](GITHUB_PUSH_GUIDE.md)

**Overall Project Info**
→ See: [PROJECT_SUMMARY.md](PROJECT_SUMMARY.md)

**API Reference**
→ See: [README.md](README.md#-api-reference)

**Troubleshooting**
→ See: [QUICK_START.md](QUICK_START.md#-troubleshooting)

---

## 📂 Directory Tree

```
pendaftaran-rs/
│
├── 📄 README.md                 ← START HERE for detailed docs
├── 📄 QUICK_START.md           ← START HERE for quick setup
├── 📄 CONTRIBUTING.md          ← For contributors
├── 📄 GITHUB_PUSH_GUIDE.md    ← For GitHub push
├── 📄 PROJECT_SUMMARY.md       ← Project overview
├── 📄 REFACTOR_PLAN.txt       ← Development roadmap
├── 📄 LICENSE                  ← MIT License
├── 📄 .gitignore              ← Git configuration
├── 📄 INDEX.md                ← This file
│
├── 📁 config/
│   ├── database.php           ← Database configuration
│   └── constants.php          ← App constants
│
├── 📁 app/
│   ├── 📁 models/
│   │   ├── Pasien.php         ← Patient model
│   │   └── ResumeMedis.php   ← Medical records model
│   │
│   ├── 📁 helpers/
│   │   └── Helper.php         ← Utility functions
│   │
│   ├── 📁 controllers/        ⏳ [Phase 2]
│   └── 📁 views/             ⏳ [Phase 3]
│
├── 📁 database/
│   └── db_pasien.sql         ← Database schema
│
├── 📁 public/
│   └── index.php            ⏳ [Phase 4]
│
└── 📁 Original Files/
    ├── index.php
    ├── daftar_pasien.php
    ├── data_pasien.php
    ├── edit_pasien.php
    ├── hapus_pasien.php
    ├── resume_medis.php
    ├── koneksi.php
    └── db_pasien.sql
```

---

## ✅ Checklist

### Before Development
- [ ] Read QUICK_START.md
- [ ] Read README.md
- [ ] Setup database
- [ ] Configure database.php
- [ ] Test models with sample data

### Before Contributing
- [ ] Read CONTRIBUTING.md
- [ ] Understand coding standards
- [ ] Check for existing similar code
- [ ] Test changes locally
- [ ] Follow commit message format

### Before Pushing to GitHub
- [ ] Read GITHUB_PUSH_GUIDE.md
- [ ] Create GitHub repository
- [ ] Follow push steps
- [ ] Verify repository online

---

## 🎯 Next Steps

1. **Quick Setup**: Follow [QUICK_START.md](QUICK_START.md)
2. **Read Docs**: Study [README.md](README.md)
3. **Explore Code**: Check [config/](config/) & [app/models/](app/models/)
4. **Phase 2**: Create controllers
5. **Phase 3**: Refactor views
6. **Phase 4**: Setup routing
7. **Phase 5**: Full testing
8. **Phase 6**: GitHub & deploy

---

## 📞 Need Help?

1. **Setup Issues**: Check [QUICK_START.md](QUICK_START.md#-troubleshooting)
2. **Code Questions**: Check [README.md](README.md) API Reference
3. **Contributing**: Check [CONTRIBUTING.md](CONTRIBUTING.md)
4. **GitHub**: Check [GITHUB_PUSH_GUIDE.md](GITHUB_PUSH_GUIDE.md)
5. **Project Info**: Check [PROJECT_SUMMARY.md](PROJECT_SUMMARY.md)

---

## 📊 File Navigator

### By Function

**Documentation**
- [README.md](README.md) - Full documentation
- [QUICK_START.md](QUICK_START.md) - Quick setup
- [CONTRIBUTING.md](CONTRIBUTING.md) - Guidelines
- [GITHUB_PUSH_GUIDE.md](GITHUB_PUSH_GUIDE.md) - GitHub guide
- [PROJECT_SUMMARY.md](PROJECT_SUMMARY.md) - Overview
- [REFACTOR_PLAN.txt](REFACTOR_PLAN.txt) - Roadmap

**Configuration**
- [config/database.php](config/database.php) - Database setup
- [config/constants.php](config/constants.php) - Constants

**Code**
- [app/models/Pasien.php](app/models/Pasien.php) - Patient model
- [app/models/ResumeMedis.php](app/models/ResumeMedis.php) - Medical model
- [app/helpers/Helper.php](app/helpers/Helper.php) - Utilities

**Database**
- [database/db_pasien.sql](database/db_pasien.sql) - Schema

**Configuration**
- [LICENSE](LICENSE) - MIT License
- [.gitignore](.gitignore) - Git rules

---

## 🎉 You're Ready!

Semua files sudah tersedia dan siap digunakan. Pilih starting point sesuai kebutuhan:

- 🚀 **Quick Setup?** → [QUICK_START.md](QUICK_START.md)
- 📖 **Learn More?** → [README.md](README.md)
- 🔧 **Develop?** → [CONTRIBUTING.md](CONTRIBUTING.md)
- 📤 **Push to GitHub?** → [GITHUB_PUSH_GUIDE.md](GITHUB_PUSH_GUIDE.md)
- 🎯 **Overview?** → [PROJECT_SUMMARY.md](PROJECT_SUMMARY.md)

---

**Happy Coding!** 🏥

*Terima kasih telah menggunakan Pendaftaran RS*

Made with ❤️ by Esa Unggul Hospital IT Team
