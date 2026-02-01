<?php
include "koneksi.php";

// Ambil data pasien berdasarkan ID
$id = $_GET['id'];
$p_query = mysqli_query($conn, "SELECT * FROM pasien WHERE id='$id'");
$p = mysqli_fetch_assoc($p_query);

// Proses update data jika tombol submit ditekan
if (isset($_POST['update'])) {
    $no_rm = mysqli_real_escape_string($conn, $_POST['no_rm']);
    $nik = mysqli_real_escape_string($conn, $_POST['nik']);
    $nama = mysqli_real_escape_string($conn, $_POST['nama']);
    $no_hp = mysqli_real_escape_string($conn, $_POST['no_hp']);
    $jk = mysqli_real_escape_string($conn, $_POST['jk']);
    $agama = mysqli_real_escape_string($conn, $_POST['agama']);
    $jenis_pembiayaan = mysqli_real_escape_string($conn, $_POST['jenis_pembiayaan']);
    $provinsi = mysqli_real_escape_string($conn, $_POST['provinsi']);
    $kota = mysqli_real_escape_string($conn, $_POST['kota']);
    $kecamatan = mysqli_real_escape_string($conn, $_POST['kecamatan']);
    $kelurahan = mysqli_real_escape_string($conn, $_POST['kelurahan']);
    $alamat = mysqli_real_escape_string($conn, $_POST['alamat']);

    mysqli_query($conn, "
        UPDATE pasien SET
            no_rm='$no_rm',
            nik='$nik',
            nama='$nama',
            no_hp='$no_hp',
            jk='$jk',
            agama='$agama',
            jenis_pembiayaan='$jenis_pembiayaan',
            provinsi='$provinsi',
            kota='$kota',
            kecamatan='$kecamatan',
            kelurahan='$kelurahan',
            alamat='$alamat'
        WHERE id='$id'
    ");

    header("location:data_pasien.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Edit Pasien - Esa Unggul Hospital</title>

<style>
/* ========================
   GLOBAL STYLING
======================== */
* { box-sizing: border-box; margin:0; padding:0; font-family: Arial,sans-serif; }
body { background:#f4f6f8; animation: fadeIn .5s ease; }
@keyframes fadeIn { from{opacity:0;transform:translateY(15px);} to{opacity:1;transform:translateY(0);} }

/* HEADER */
.header { background: linear-gradient(135deg,#0d47a1,#1565c0); color:white; padding:22px 30px; }
.header h1 { font-size:26px; }
.header span { font-size:14px; opacity:.9; }

/* NAVBAR */
.navbar { position: sticky; top:0; z-index:1000; background:white; box-shadow:0 4px 14px rgba(0,0,0,.1); }
.nav { display:flex; gap:30px; padding:14px 30px; }
.nav a { text-decoration:none; color:#0d47a1; font-weight:bold; padding:6px 0; position:relative; }
.nav a::after { content:''; position:absolute; bottom:0; left:0; width:0; height:3px; background:#0d47a1; transition:.35s; }
.nav a:hover::after { width:100%; }

/* CONTAINER */
.container { padding:35px; }

/* FORM BOX */
.form-box {
    max-width:800px;
    margin:auto;
    background:white;
    padding:32px;
    border-radius:20px;
    box-shadow:0 10px 24px rgba(0,0,0,.15);
}
.form-box h2 { color:#0d47a1; margin-bottom:6px; }
.form-box p { color:#555; margin-bottom:20px; }

/* GRID FORM */
.grid { display:grid; grid-template-columns:1fr 1fr; gap:16px; }
.full { grid-column:1/3; }

input, select, textarea {
    width:100%; padding:12px; border-radius:10px; border:1px solid #ccc;
}
input:focus, select:focus, textarea:focus {
    outline:none; border-color:#1e88e5; box-shadow:0 0 0 2px rgba(30,136,229,.2);
}
textarea { resize:none; height:90px; }

/* BUTTON */
button {
    margin-top:22px;
    width:100%;
    padding:14px;
    background: linear-gradient(135deg,#1e88e5,#1565c0);
    color:white; border:none; border-radius:14px;
    font-size:16px; cursor:pointer;
    transition:.3s;
}
button:hover { transform:translateY(-2px); box-shadow:0 8px 20px rgba(0,0,0,.25); }

/* FOOTER */
.footer { margin-top:50px; background:#0d47a1; color:white; text-align:center; padding:16px; font-size:13px; }
</style>
</head>

<body>

<div class="header">
    <h1>Esa Unggul Hospital</h1>
    <span>Sistem Informasi Pendaftaran Pasien</span>
</div>

<div class="navbar">
    <div class="nav">
        <a href="index.php">Dashboard</a>
        <a href="daftar_pasien.php">Daftar Pasien</a>
        <a href="data_pasien.php">Data Pasien</a>
    </div>
</div>

<div class="container">
<div class="form-box">
<h2>Edit Data Pasien</h2>
<p>Perbarui data pasien dengan benar</p>

<form method="post">
    <div class="grid">

        <!-- Identitas -->
        <input name="no_rm" placeholder="No Rekam Medis" value="<?= htmlspecialchars($p['no_rm']) ?>" required>
        <input name="nik" placeholder="NIK" maxlength="16" value="<?= htmlspecialchars($p['nik']) ?>" required>

        <input name="nama" placeholder="Nama Pasien" value="<?= htmlspecialchars($p['nama']) ?>" required>
        <input name="no_hp" placeholder="No HP" value="<?= htmlspecialchars($p['no_hp']) ?>" required>

        <select name="jk" required>
            <option value="">-- Jenis Kelamin --</option>
            <option value="Laki-laki" <?= $p['jk']=='Laki-laki'?'selected':'' ?>>Laki-laki</option>
            <option value="Perempuan" <?= $p['jk']=='Perempuan'?'selected':'' ?>>Perempuan</option>
            <option value="Tidak diketahui" <?= $p['jk']=='Tidak diketahui'?'selected':'' ?>>Tidak diketahui</option>
            <option value="Tidak dapat ditentukan" <?= $p['jk']=='Tidak dapat ditentukan'?'selected':'' ?>>Tidak dapat ditentukan</option>
            <option value="Tidak mengisi" <?= $p['jk']=='Tidak mengisi'?'selected':'' ?>>Tidak mengisi</option>
        </select>

        <select name="agama" required>
            <option value="">-- Agama --</option>
            <option value="Islam" <?= $p['agama']=='Islam'?'selected':'' ?>>Islam</option>
            <option value="Kristen Protestan" <?= $p['agama']=='Kristen Protestan'?'selected':'' ?>>Kristen Protestan</option>
            <option value="Katolik" <?= $p['agama']=='Katolik'?'selected':'' ?>>Katolik</option>
            <option value="Hindu" <?= $p['agama']=='Hindu'?'selected':'' ?>>Hindu</option>
            <option value="Budha" <?= $p['agama']=='Budha'?'selected':'' ?>>Budha</option>
            <option value="Konghucu" <?= $p['agama']=='Konghucu'?'selected':'' ?>>Konghucu</option>
            <option value="Penghayat" <?= $p['agama']=='Penghayat'?'selected':'' ?>>Penghayat</option>
        </select>

        <select name="jenis_pembiayaan" required>
            <option value="">-- Jenis Pembiayaan --</option>
            <option value="JKN" <?= $p['jenis_pembiayaan']=='JKN'?'selected':'' ?>>JKN</option>
            <option value="Umum" <?= $p['jenis_pembiayaan']=='Umum'?'selected':'' ?>>Umum</option>
            <option value="Asuransi" <?= $p['jenis_pembiayaan']=='Asuransi'?'selected':'' ?>>Asuransi</option>
        </select>

        <!-- Alamat -->
        <input name="provinsi" placeholder="Provinsi" value="<?= htmlspecialchars($p['provinsi']) ?>">
        <input name="kota" placeholder="Kota" value="<?= htmlspecialchars($p['kota']) ?>">
        <input name="kecamatan" placeholder="Kecamatan" value="<?= htmlspecialchars($p['kecamatan']) ?>">
        <input name="kelurahan" placeholder="Kelurahan" value="<?= htmlspecialchars($p['kelurahan']) ?>">
        <textarea name="alamat" class="full" placeholder="Alamat Lengkap"><?= htmlspecialchars($p['alamat']) ?></textarea>

    </div>

    <button name="update">Update Data Pasien</button>
</form>
</div>
</div>

<div class="footer">
    © <?= date('Y') ?> Esa Unggul Hospital | All Rights Reserved
</div>

</body>
</html>
