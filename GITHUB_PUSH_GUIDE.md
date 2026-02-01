# 📤 Push ke GitHub - Panduan Lengkap

Panduan step-by-step untuk push project **Pendaftaran RS** ke GitHub repository.

## 📋 Prerequisites

Sebelum memulai, pastikan Anda sudah punya:

1. ✅ **GitHub Account** - Buat di [github.com](https://github.com)
2. ✅ **Git Installed** - Download dari [git-scm.com](https://git-scm.com)
3. ✅ **Project Folder** - Folder `pendaftaran-rs` dengan semua files
4. ✅ **Terminal/PowerShell** - Ready untuk menjalankan commands
5. ✅ **Text Editor** - VS Code atau editor lain

## 🔧 Step-by-Step Guide

### Step 1: Create GitHub Repository

1. **Login ke GitHub**
   - Buka [github.com](https://github.com)
   - Masukkan username dan password

2. **Create New Repository**
   - Klik tombol **`+`** di top right → **New repository**
   - Atau buka [github.com/new](https://github.com/new)

3. **Isi Form Repository**
   ```
   Repository name: pendaftaran-rs
   Description: Sistem Informasi Pendaftaran Pasien Rumah Sakit Esa Unggul
   Visibility: Public (atau Private sesuai kebutuhan)
   ```

4. **Skip Initialization**
   - ❌ JANGAN centang "Initialize this repository with a README"
   - ❌ JANGAN centang "Add .gitignore"
   - ❌ JANGAN centang "Add a license"
   - (Karena kita sudah punya file-file ini)

5. **Click Create Repository**
   - Repository berhasil dibuat
   - GitHub akan show URL: `https://github.com/your-username/pendaftaran-rs.git`

### Step 2: Setup Git Local

Buka **PowerShell** atau **Command Prompt**:

```powershell
# Navigate ke project folder
cd "C:\path\to\pendaftaran-rs"

# Cek apakah sudah masuk folder yang tepat
dir
```

Pastikan folder mengandung: `README.md`, `app/`, `config/`, `database/`, dll

#### Configure Git (Pertama kali saja)

```powershell
# Setup nama & email (gunakan email GitHub Anda)
git config --global user.name "Nama Anda"
git config --global user.email "email@example.com"

# Verify configuration
git config --global --list
```

**Output yang diharapkan:**
```
user.name=Nama Anda
user.email=email@example.com
...
```

### Step 3: Initialize Git

```powershell
# Inisialisasi git repository
git init

# Verify git initialized
git status
```

**Output yang diharapkan:**
```
On branch master

No commits yet

Untracked files:
  (use "git add <file>..." to include in what will be committed)
        .gitignore
        CONTRIBUTING.md
        LICENSE
        README.md
        app/
        config/
        ...

nothing added to commit but untracked files present (tracking what will be committed)
```

### Step 4: Add Files

```powershell
# Add semua files
git add .

# Verify files to be committed
git status
```

**Output yang diharapkan:**
```
On branch master

Initial commit

Changes to be committed:
  (use "git rm --cached <file>..." to unstage)
        new file:   .gitignore
        new file:   CONTRIBUTING.md
        new file:   LICENSE
        new file:   README.md
        new file:   app/controllers/...
        new file:   app/helpers/Helper.php
        new file:   app/models/Pasien.php
        new file:   app/models/ResumeMedis.php
        ...
```

### Step 5: Create Initial Commit

```powershell
# Commit dengan pesan yang deskriptif
git commit -m "Initial commit: Pendaftaran RS - Sistem Informasi Pendaftaran Pasien"
```

**Output yang diharapkan:**
```
[master (root-commit) abc1234] Initial commit: Pendaftaran RS - Sistem Informasi Pendaftaran Pasien
 15 files changed, 2500 insertions(+)
 create mode 100644 .gitignore
 create mode 100644 CONTRIBUTING.md
 create mode 100644 LICENSE
 create mode 100644 README.md
 ...
```

### Step 6: Add Remote Repository

```powershell
# Add remote origin (ganti YOUR-USERNAME dengan username GitHub Anda)
git remote add origin https://github.com/YOUR-USERNAME/pendaftaran-rs.git

# Verify remote
git remote -v
```

**Output yang diharapkan:**
```
origin  https://github.com/YOUR-USERNAME/pendaftaran-rs.git (fetch)
origin  https://github.com/YOUR-USERNAME/pendaftaran-rs.git (push)
```

### Step 7: Push ke GitHub

#### Untuk First Time Push:

```powershell
# Push ke GitHub
# Ganti main dengan master jika branch Anda master
git push -u origin main
```

⚠️ **Jika mendapat error:**

```
error: remote origin already exists
```

Maka jalankan:
```powershell
git remote remove origin
git remote add origin https://github.com/YOUR-USERNAME/pendaftaran-rs.git
git push -u origin main
```

#### Jika Branch Masih Master:

GitHub akan request untuk ganti ke `main`. Jalankan:

```powershell
# Rename branch dari master ke main (optional)
git branch -M main

# Kemudian push
git push -u origin main
```

**Output yang diharapkan:**
```
Enumerating objects: 15, done.
Counting objects: 100% (15/15), done.
Delta compression using up to 8 threads
Compressing objects: 100% (12/12), done.
Writing objects: 100% (15/15), 5.42 KiB | 5.42 MiB/s, done.
Total 15 (delta 0), reused 0 (delta 0), pack-reused 0
To https://github.com/YOUR-USERNAME/pendaftaran-rs.git
 * [new branch]      main -> main
Branch 'main' set up to track remote branch 'main' from 'origin'.
```

### Step 8: Verify di GitHub

1. Buka [github.com/your-username/pendaftaran-rs](https://github.com/your-username/pendaftaran-rs)
2. Verifikasi semua files sudah ter-upload:
   - ✅ `README.md`
   - ✅ `CONTRIBUTING.md`
   - ✅ `LICENSE`
   - ✅ `.gitignore`
   - ✅ `app/` folder
   - ✅ `config/` folder
   - ✅ `database/` folder
   - ✅ etc

Jika semua ada, **Selamat!** 🎉 Project sudah berhasil di-push ke GitHub!

## 🔄 Subsequent Pushes (Update Selanjutnya)

Setelah initial push, untuk push update berikutnya:

```powershell
# Navigate ke folder
cd "C:\path\to\pendaftaran-rs"

# Check status
git status

# Add changes
git add .

# Commit
git commit -m "feat: deskripsi perubahan yang dibuat"

# Push
git push origin main
```

## 🚀 Advanced: Using SSH Instead of HTTPS

### Generate SSH Key

```powershell
# Generate SSH key
ssh-keygen -t rsa -b 4096 -C "email@example.com"

# Press Enter untuk semua prompts (gunakan default)
```

### Add SSH Key ke GitHub

1. Open PowerShell dan copy SSH key:
```powershell
type $env:USERPROFILE\.ssh\id_rsa.pub | clip
```

2. Go to [github.com/settings/keys](https://github.com/settings/keys)
3. Click **New SSH key**
4. Paste key dan save

### Use SSH for Remote

```powershell
# Change remote dari HTTPS ke SSH
git remote set-url origin git@github.com:YOUR-USERNAME/pendaftaran-rs.git

# Verify
git remote -v
```

## 📝 Important Git Commands Reference

| Command | Deskripsi |
|---------|-----------|
| `git init` | Initialize git repository |
| `git status` | Check current status |
| `git add .` | Add semua files |
| `git add <file>` | Add specific file |
| `git commit -m "message"` | Create commit |
| `git push` | Push ke remote |
| `git pull` | Pull dari remote |
| `git clone <url>` | Clone repository |
| `git log` | View commit history |
| `git branch` | List branches |
| `git checkout -b <branch>` | Create new branch |
| `git merge <branch>` | Merge branch |

## ⚠️ Common Issues & Solutions

### Issue 1: Authentication Failed

**Error:**
```
fatal: Authentication failed for 'https://github.com/...'
```

**Solution:**
```powershell
# Use SSH instead atau
# Setup git credential manager

# Check if using HTTPS
git remote -v

# Change to SSH
git remote set-url origin git@github.com:YOUR-USERNAME/pendaftaran-rs.git
```

### Issue 2: Repository Already Exists

**Error:**
```
fatal: destination path 'pendaftaran-rs' already exists and is not an empty directory.
```

**Solution:**
```powershell
# Pastikan Anda di dalam folder project
cd pendaftaran-rs

# Jangan clone lagi, init saja
git init
```

### Issue 3: SSL Certificate Error

**Error:**
```
fatal: unable to access 'https://github.com/...' : SSL certificate problem
```

**Solution (Windows):**
```powershell
# Disable SSL verification (NOT recommended for production)
git config --global http.sslVerify false

# Atau install Git with OpenSSL
```

### Issue 4: Branch Name Mismatch

**Error:**
```
error: src refspec main does not match any
```

**Solution:**
```powershell
# Check current branch
git branch

# Jika master, rename ke main
git branch -M main

# Push dengan -u flag
git push -u origin main
```

## ✅ Checklist Sebelum Push

- [ ] Semua files sudah ready
- [ ] `.gitignore` sudah created
- [ ] README.md sudah jelas
- [ ] GitHub repository sudah dibuat
- [ ] Git config sudah setup
- [ ] Files sudah di-add
- [ ] Initial commit sudah dibuat
- [ ] Remote origin sudah di-add
- [ ] Siap untuk push!

## 📚 References

- [GitHub Getting Started](https://docs.github.com/en/get-started)
- [Git Documentation](https://git-scm.com/doc)
- [GitHub Guides](https://guides.github.com/)

## 💡 Tips

1. **Commit Often** - Jangan menunggu sampai banyak changes baru commit
2. **Descriptive Messages** - Gunakan pesan commit yang jelas
3. **Keep it Clean** - Push hanya yang diperlukan, gunakan `.gitignore`
4. **Review Before Push** - Check files sebelum commit
5. **Backup Local** - Keep backup folder di local sebelum push

---

## 🎉 Selamat!

Jika semua steps berhasil, project Anda sekarang sudah di GitHub dan siap untuk:
- ✅ Sharing dengan team
- ✅ Collaboration
- ✅ Version control
- ✅ Backup online
- ✅ Portfolio project

**Terima kasih!** 🙏

Untuk bantuan lebih lanjut, silakan buka [GitHub Issues](https://github.com/yourusername/pendaftaran-rs/issues)

---

Made with ❤️ by Esa Unggul Hospital IT Team
