<?php
include "koneksi.php";

/* ============================
   TIPE PASIEN (BARU / LAMA)
============================ */
$type = isset($_GET['type']) ? $_GET['type'] : 'baru';

/* ============================
   SIMPAN DATA PASIEN BARU
============================ */
if(isset($_POST['simpan'])) {

    // Amankan input
    $no_rm            = mysqli_real_escape_string($conn, $_POST['no_rm']);
    $nik              = mysqli_real_escape_string($conn, $_POST['nik']);
    $nama             = mysqli_real_escape_string($conn, $_POST['nama']);
    $no_hp            = mysqli_real_escape_string($conn, $_POST['no_hp']);
    $jk               = mysqli_real_escape_string($conn, $_POST['jk']);
    $agama            = mysqli_real_escape_string($conn, $_POST['agama']);
    $jenis_pembiayaan = mysqli_real_escape_string($conn, $_POST['jenis_pembiayaan']);
    $provinsi         = mysqli_real_escape_string($conn, $_POST['provinsi']);
    $kota             = mysqli_real_escape_string($conn, $_POST['kota']);
    $kecamatan        = mysqli_real_escape_string($conn, $_POST['kecamatan']);
    $kelurahan        = mysqli_real_escape_string($conn, $_POST['kelurahan']);
    $alamat           = mysqli_real_escape_string($conn, $_POST['alamat']);

    // Simpan ke database
    mysqli_query($conn,"
        INSERT INTO pasien (
            no_rm, nik, nama, no_hp, jk, agama,
            jenis_pembiayaan, provinsi, kota,
            kecamatan, kelurahan, alamat
        ) VALUES (
            '$no_rm','$nik','$nama','$no_hp','$jk','$agama',
            '$jenis_pembiayaan','$provinsi','$kota',
            '$kecamatan','$kelurahan','$alamat'
        )
    ");

    header("location:data_pasien.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Daftar Pasien - Esa Unggul Hospital</title>

<style>
/* ============================
   GLOBAL
============================ */
*{
    box-sizing:border-box;
    margin:0;
    padding:0;
    font-family:Arial,sans-serif;
}
body{
    background:#f4f6f8;
}

/* ============================
   ANIMASI UMUM
============================ */
.fade-hover{
    transition:.35s ease;
}
.fade-hover:hover{
    transform:translateY(-4px);
    background:#1e88e5 !important;
    color:white !important;
}

/* ============================
   HEADER
============================ */
.header{
    background:linear-gradient(135deg,#0d47a1,#1565c0);
    color:white;
    padding:22px 30px;
}
.header h1{font-size:26px;}
.header span{font-size:14px;opacity:.9;}

/* ============================
   NAVBAR
============================ */
.navbar{
    position:sticky;
    top:0;
    z-index:1000;
    background:white;
    padding:14px 30px;
    display:flex;
    gap:30px;
    box-shadow:0 4px 14px rgba(0,0,0,.1);
}
.navbar a{
    position:relative;
    text-decoration:none;
    color:#0d47a1;
    font-weight:bold;
    padding:6px 0;
}
.navbar a::after{
    content:'';
    position:absolute;
    left:0;
    bottom:0;
    width:0;
    height:3px;
    background:#0d47a1;
    transition:.35s;
}
.navbar a:hover::after{
    width:100%;
}

/* ============================
   MENU PASIEN BARU / LAMA
============================ */
.patient-options{
    text-align:center;
    margin:22px 0;
}
.patient-options a{
    display:inline-block;
    padding:12px 22px;
    background:#e3f2fd;
    color:#0d47a1;
    border-radius:12px;
    text-decoration:none;
    font-weight:bold;
    margin:0 6px;
}
.patient-options a.active-option{
    background:#1e88e5;
    color:white;
}

/* ============================
   CONTAINER
============================ */
.container{
    padding:35px;
    animation:fade .45s ease;
}
@keyframes fade{
    from{opacity:0;transform:translateY(15px)}
    to{opacity:1}
}

/* ============================
   FORM BOX
============================ */
.form-box{
    max-width:820px;
    margin:auto;
    background:white;
    padding:30px;
    border-radius:18px;
    box-shadow:0 10px 24px rgba(0,0,0,.15);
}
.form-box h2{
    color:#0d47a1;
}
.form-box p{
    color:#666;
    margin:8px 0 20px;
}

/* ============================
   GRID FORM
============================ */
.grid{
    display:grid;
    grid-template-columns:1fr 1fr;
    gap:16px;
}
.full{
    grid-column:1/3;
}

/* ============================
   INPUT
============================ */
input,select,textarea,button{
    width:100%;
    padding:12px;
    border-radius:10px;
    border:1px solid #ccc;
}
textarea{
    resize:none;
    height:90px;
}

/* ============================
   BUTTON
============================ */
button{
    margin-top:22px;
    background:#1e88e5;
    color:white;
    border:none;
    border-radius:14px;
    font-size:16px;
    cursor:pointer;
}
button:hover{
    opacity:.9;
}

/* ============================
   FOOTER
============================ */
.footer{
    margin-top:60px;
    background:#0d47a1;
    color:white;
    text-align:center;
    padding:16px;
    font-size:13px;
}
</style>
</head>

<body>

<!-- HEADER -->
<div class="header">
    <h1>Esa Unggul Hospital</h1>
    <span>Sistem Informasi Pendaftaran Pasien</span>
</div>

<!-- NAVBAR -->
<div class="navbar">
    <a href="index.php">Dashboard</a>
    <a href="daftar_pasien.php?type=baru">Daftar Pasien</a>
    <a href="data_pasien.php">Data Pasien</a>
</div>

<!-- MENU PASIEN BARU / LAMA -->
<div class="patient-options">
    <a class="fade-hover <?= ($type=='baru')?'active-option':'' ?>"
       href="daftar_pasien.php?type=baru">Pasien Baru</a>

    <a class="fade-hover <?= ($type=='lama')?'active-option':'' ?>"
       href="daftar_pasien.php?type=lama">Pasien Lama</a>
</div>

<!-- CONTENT -->
<div class="container">
<div class="form-box">

<?php if($type == 'baru'): ?>

    <!-- ================= FORM PASIEN BARU ================= -->
    <h2>Form Pendaftaran Pasien Baru</h2>
    <p>Lengkapi data identitas pasien dengan benar</p>

    <form method="post">
        <div class="grid">

            <input name="no_rm" placeholder="No Rekam Medis" required>
            <input name="nik" maxlength="16" placeholder="NIK (16 digit)" required>

            <input name="nama" placeholder="Nama Pasien" required>
            <input name="no_hp" placeholder="No HP" required>

            <select name="jk" required>
                <option value="">-- Jenis Kelamin --</option>
                <option>Tidak diketahui</option>
                <option>Laki-laki</option>
                <option>Perempuan</option>
                <option>Tidak dapat ditentukan</option>
                <option>Tidak mengisi</option>
            </select>

            <select name="agama" required>
                <option value="">-- Pilih Agama --</option>
                <option>Islam</option>
                <option>Kristen Protestan</option>
                <option>Katolik</option>
                <option>Hindu</option>
                <option>Budha</option>
                <option>Konghucu</option>
                <option>Penghayat</option>
            </select>

            <select name="jenis_pembiayaan" required>
                <option value="">-- Jenis Pembayaran --</option>
                <option>JKN</option>
                <option>Umum</option>
                <option>Asuransi</option>
            </select>

            <select name="provinsi" required>
                <option value="">-- Pilih Provinsi --</option>
                <option>DKI Jakarta</option>
                <option>Jawa Barat</option>
                <option>Jawa Tengah</option>
                <option>Jawa Timur</option>
                <option>Banten</option>
            </select>

            <input name="kota" placeholder="Kota / Kabupaten">
            <input name="kecamatan" placeholder="Kecamatan">
            <input name="kelurahan" placeholder="Kelurahan">

            <textarea name="alamat" class="full" placeholder="Alamat Lengkap"></textarea>

        </div>

        <button name="simpan">Simpan Data Pasien</button>
    </form>

<?php else: ?>

    <!-- ================= PASIEN LAMA ================= -->
    <h2>Pilih Pasien Lama</h2>
    <p>Cari pasien berdasarkan No RM atau NIK</p>

    <form method="get" action="data_pasien.php">
        <input name="q" placeholder="No RM / NIK" required>
        <button type="submit">Cari Pasien</button>
    </form>

<?php endif; ?>

</div>
</div>

<!-- FOOTER -->
<div class="footer">
    © <?= date('Y') ?> Esa Unggul Hospital | All Rights Reserved
</div>

</body>
</html>
