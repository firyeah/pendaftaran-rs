<?php
include "koneksi.php";

$id   = $_GET['id']   ?? 0;
$menu = $_GET['menu'] ?? 'input';

/* ===============================
   AMBIL DATA PASIEN
================================ */
$pasien = mysqli_fetch_assoc(
    mysqli_query($conn,"SELECT * FROM pasien WHERE id='$id'")
);
if(!$pasien){
    echo "Data pasien tidak ditemukan";
    exit;
}

/* ===============================
   SIMPAN RESUME
================================ */
if(isset($_POST['simpan'])){
    mysqli_query($conn,"
        INSERT INTO resume_medis 
        (pasien_id, keluhan_utama, diagnosis, snomed_tindakan, snomed_obat, catatan, total_biaya)
        VALUES (
            '$id',
            '$_POST[keluhan]',
            '$_POST[diagnosis]',
            '$_POST[snomed_tindakan]',
            '$_POST[snomed_obat]',
            '$_POST[catatan]',
            '$_POST[total_biaya]'
        )
    ");
    header("location:resume_medis.php?id=$id&menu=riwayat");
    exit;
}

/* ===============================
   UPDATE RESUME
================================ */
if(isset($_POST['update_id'])){
    mysqli_query($conn,"
        UPDATE resume_medis SET
            keluhan_utama   = '$_POST[keluhan]',
            diagnosis       = '$_POST[diagnosis]',
            snomed_tindakan = '$_POST[snomed_tindakan]',
            snomed_obat     = '$_POST[snomed_obat]',
            catatan         = '$_POST[catatan]',
            total_biaya     = '$_POST[total_biaya]'
        WHERE id='$_POST[update_id]' AND pasien_id='$id'
    ");
    header("location:resume_medis.php?id=$id&menu=riwayat");
    exit;
}

/* ===============================
   HAPUS RESUME
================================ */
if(isset($_GET['hapus_id'])){
    mysqli_query($conn,"
        DELETE FROM resume_medis 
        WHERE id='$_GET[hapus_id]' AND pasien_id='$id'
    ");
    header("location:resume_medis.php?id=$id&menu=riwayat");
    exit;
}

/* ===============================
   MODE EDIT
================================ */
$edit = null;
if(isset($_GET['edit_id'])){
    $edit = mysqli_fetch_assoc(
        mysqli_query($conn,"
            SELECT * FROM resume_medis 
            WHERE id='$_GET[edit_id]' AND pasien_id='$id'
        ")
    );
    $menu = 'input';
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Resume Medis</title>

<style>
*{margin:0;padding:0;box-sizing:border-box;font-family:Arial,sans-serif}
body{background:#f4f6f8;animation:fade .4s ease}
@keyframes fade{from{opacity:0;transform:translateY(10px)}to{opacity:1}}

.header{
    background:linear-gradient(135deg,#0d47a1,#1565c0);
    color:white;
    padding:22px 30px;
}
.header h1{font-size:26px}

.container{padding:30px}

/* ===== MENU ===== */
.menu-center{
    display:flex;
    justify-content:center;
    gap:15px;
    margin-bottom:25px;
}
.menu-center a{
    padding:10px 18px;
    background:#e3f2fd;
    border-radius:10px;
    text-decoration:none;
    color:#0d47a1;
    font-weight:bold;
    transition:.3s;
}
.menu-center a:hover{
    background:#1e88e5;
    color:white;
    transform:translateY(-3px);
}

/* ===== BOX ===== */
.box{
    background:white;
    padding:30px;
    border-radius:18px;
    box-shadow:0 10px 24px rgba(0,0,0,.15);
    margin-bottom:30px;
}

/* ===== DATA PASIEN ===== */
.info-grid{
    display:grid;
    grid-template-columns:repeat(3,1fr);
    gap:15px;
}
.info-card{
    background:#f5faff;
    padding:14px;
    border-radius:14px;
}
.info-card span{font-size:12px;color:#777}
.info-card b{display:block;margin-top:6px;color:#0d47a1}
.info-card.full{grid-column:1/4}

/* ===== FORM ===== */
label{font-weight:bold;margin-top:14px;display:block}
input,textarea{
    width:100%;
    padding:12px;
    border-radius:10px;
    border:1px solid #ccc;
    margin-top:6px;
}
textarea{height:90px;resize:none}
.snomed{display:flex;gap:10px}
.snomed a{
    padding:12px 18px;
    background:#1e88e5;
    color:white;
    border-radius:10px;
    text-decoration:none;
}
button{
    margin-top:20px;
    width:100%;
    padding:14px;
    background:#1e88e5;
    border:none;
    color:white;
    border-radius:14px;
    font-size:16px;
}

/* ===== TABLE (RAPIH & FIX) ===== */
.table-wrap{
    overflow-x:auto;
}

table{
    width:100%;
    border-collapse:collapse;
    table-layout:fixed;
}

th, td{
    border:1px solid #e0e0e0;
    padding:10px;
    font-size:13px;
    vertical-align:top;
}

th{
    background:#1e88e5;
    color:white;
    text-align:center;
}

td{
    background:#fff;
}

/* ===== KOLOM AKSI ===== */
th.aksi, td.aksi{
    width:110px;
    text-align:center;
}

.aksi{
    display:flex;
    justify-content:center;
    gap:6px;
}

.aksi a{
    padding:6px 8px;
    border-radius:6px;
    font-size:12px;
    color:white;
    text-decoration:none;
    white-space:nowrap;
}

.edit{background:#ffb300}
.hapus{background:#e53935}

/* ===== MODAL ===== */
.modal{
    position:fixed;
    inset:0;
    background:rgba(0,0,0,.45);
    display:none;
    align-items:center;
    justify-content:center;
}
.modal-box{
    background:white;
    padding:26px;
    border-radius:18px;
    width:360px;
    text-align:center;
}
.modal-action{
    margin-top:20px;
    display:flex;
    justify-content:center;
    gap:12px;
}
.btn-batal{background:#b0bec5;color:white;padding:10px 18px;border-radius:10px;border:none}
.btn-hapus{background:#e53935;color:white;padding:10px 18px;border-radius:10px;text-decoration:none}

/* ===== FOOTER ===== */
.footer{
    background:#0d47a1;
    color:white;
    text-align:center;
    padding:16px;
}
</style>
</head>

<body>

<div class="header">
    <h1>Esa Unggul Hospital</h1>
</div>

<div class="container">

<div class="menu-center">
    <a href="data_pasien.php">← Kembali</a>
    <a href="?id=<?= $id ?>&menu=input">Input Resume</a>
    <a href="?id=<?= $id ?>&menu=riwayat">Riwayat Resume</a>
</div>

<!-- DATA PASIEN -->
<div class="box">
    <h2>Data Pasien</h2>
    <div class="info-grid">
        <div class="info-card"><span>Nama</span><b><?= $pasien['nama'] ?></b></div>
        <div class="info-card"><span>No RM</span><b><?= $pasien['no_rm'] ?></b></div>
        <div class="info-card"><span>Jenis Kelamin</span><b><?= $pasien['jk'] ?></b></div>
        <div class="info-card"><span>No HP</span><b><?= $pasien['no_hp'] ?></b></div>
        <div class="info-card"><span>Jenis Pembayaran</span><b><?= $pasien['jenis_pembiayaan'] ?></b></div>
        <div class="info-card full"><span>Alamat</span><b><?= $pasien['alamat'] ?></b></div>
    </div>
</div>

<?php if($menu=='input'): ?>
<div class="box">
<h2><?= $edit ? "Edit Resume Medis" : "Input Resume Medis" ?></h2>
<form method="post">

<label>Keluhan Utama</label>
<textarea name="keluhan"><?= $edit['keluhan_utama'] ?? '' ?></textarea>

<label>Diagnosis</label>
<textarea name="diagnosis"><?= $edit['diagnosis'] ?? '' ?></textarea>

<label>SNOMED Tindakan</label>
<div class="snomed">
<input id="tindakan" name="snomed_tindakan" value="<?= $edit['snomed_tindakan'] ?? '' ?>">
<a href="javascript:cariSNOMED('tindakan')">Cari</a>
</div>

<label>SNOMED Obat</label>
<div class="snomed">
<input id="obat" name="snomed_obat" value="<?= $edit['snomed_obat'] ?? '' ?>">
<a href="javascript:cariSNOMED('obat')">Cari</a>
</div>

<label>Catatan Medis</label>
<textarea name="catatan"><?= $edit['catatan'] ?? '' ?></textarea>

<label>Total Biaya</label>
<input type="number" name="total_biaya" value="<?= $edit['total_biaya'] ?? '' ?>">

<?php if($edit): ?>
<input type="hidden" name="update_id" value="<?= $edit['id'] ?>">
<?php else: ?>
<input type="hidden" name="simpan" value="1">
<?php endif; ?>

<button>Simpan</button>
</form>
</div>
<?php endif; ?>

<?php if($menu=='riwayat'): ?>
<div class="box">
<h2>Riwayat Resume Medis</h2>

<div class="table-wrap">
<table>
<tr>
    <th>Tanggal</th>
    <th>Keluhan</th>
    <th>Diagnosis</th>
    <th>SNOMED Tindakan</th>
    <th>SNOMED Obat</th>
    <th>Catatan</th>
    <th>Total Biaya</th>
    <th class="aksi">Aksi</th>
</tr>
<?php
$q=mysqli_query($conn,"SELECT * FROM resume_medis WHERE pasien_id='$id' ORDER BY tanggal DESC");
while($r=mysqli_fetch_assoc($q)):
?>
<tr>
<td><?= $r['tanggal'] ?></td>
<td><?= $r['keluhan_utama'] ?></td>
<td><?= $r['diagnosis'] ?></td>
<td><?= $r['snomed_tindakan'] ?></td>
<td><?= $r['snomed_obat'] ?></td>
<td><?= $r['catatan'] ?></td>
<td>Rp <?= number_format($r['total_biaya'],0,',','.') ?></td>
<td class="aksi">
    <a class="edit" href="?id=<?= $id ?>&edit_id=<?= $r['id'] ?>">Edit</a>
    <a class="hapus" href="#" onclick="hapus(<?= $r['id'] ?>)">Hapus</a>
</td>
</tr>
<?php endwhile; ?>
</table>
</div>
</div>
<?php endif; ?>

</div>

<!-- MODAL -->
<div class="modal" id="modal">
<div class="modal-box">
<h3>Konfirmasi</h3>
<p>Apakah Anda yakin ingin menghapus resume medis ini?</p>
<div class="modal-action">
<button class="btn-batal" onclick="tutup()">Batal</button>
<a id="linkHapus" class="btn-hapus">Hapus</a>
</div>
</div>
</div>

<div class="footer">
© <?= date('Y') ?> Esa Unggul Hospital | All Rights Reserved
</div>

<script>
function cariSNOMED(id){
    let q=document.getElementById(id).value;
    if(!q) return alert("Isi dulu kata kunci");
    window.open("https://browser.ihtsdotools.org/?query="+encodeURIComponent(q),"_blank");
}
function hapus(id){
    document.getElementById('modal').style.display='flex';
    document.getElementById('linkHapus').href='?id=<?= $id ?>&hapus_id='+id;
}
function tutup(){
    document.getElementById('modal').style.display='none';
}
</script>

</body>
</html>
