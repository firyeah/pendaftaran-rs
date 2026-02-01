<?php
include "koneksi.php";

// Ambil query pencarian
$q = isset($_GET['q']) ? mysqli_real_escape_string($conn, $_GET['q']) : '';

// Ambil data pasien sesuai pencarian
$data = mysqli_query($conn, "
    SELECT * FROM pasien
    WHERE no_rm LIKE '%$q%'
       OR nama LIKE '%$q%'
       OR nik LIKE '%$q%'
    ORDER BY created_at DESC
");
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Data Pasien - Esa Unggul Hospital</title>

<style>
*{box-sizing:border-box;margin:0;padding:0;font-family:Arial,sans-serif;}
body{background:#f4f6f8;}

/* HEADER */
.header{
    background:linear-gradient(135deg,#0d47a1,#1565c0);
    color:white;
    padding:22px 30px;
}
.header h1{font-size:26px;}
.header span{font-size:14px;opacity:.9;}

/* NAVBAR */
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
    text-decoration:none;
    color:#0d47a1;
    font-weight:bold;
    position:relative;
    padding:6px 0;
}
.navbar a::after{
    content:'';
    position:absolute;
    left:0; bottom:0;
    width:0; height:3px;
    background:#0d47a1;
    transition:.35s;
}
.navbar a:hover::after{width:100%;}

/* CONTAINER */
.container{padding:35px;}

/* BOX */
.box{
    background:white;
    padding:28px;
    border-radius:18px;
    box-shadow:0 10px 24px rgba(0,0,0,.15);
}
.box h2{color:#0d47a1;}
.box p{color:#666;margin:8px 0 20px;}

/* SEARCH */
.search{
    display:flex;
    gap:10px;
    margin-bottom:20px;
}
.search input{
    flex:1;
    padding:12px;
    border-radius:10px;
    border:1px solid #ccc;
}
.search button{
    padding:12px 22px;
    background:#1e88e5;
    color:white;
    border:none;
    border-radius:10px;
    cursor:pointer;
}

/* TABLE */
table{
    width:100%;
    border-collapse:collapse;
    font-size:14px;
}
th{
    background:#1e88e5;
    color:white;
    padding:14px;
    text-align:left;
}
td{
    padding:12px;
    border-bottom:1px solid #eee;
    vertical-align:top;
}
tr.data-row{
    cursor:pointer;
    transition:.3s;
}
tr.data-row:hover{
    background:#f5faff;
}

/* BADGE */
.badge{
    padding:6px 12px;
    border-radius:20px;
    font-size:12px;
    color:white;
}
.Laki-laki{background:#2196f3;}
.Perempuan{background:#e91e63;}
.Tidak\ diketahui{background:#9e9e9e;}
.Tidak\ dapat\ ditentukan{background:#607d8b;}
.Tidak\ mengisi{background:#b0bec5;}

/* ACTION */
.action{
    display:flex;
    gap:6px;
}
.action a{
    text-decoration:none;
    padding:6px 12px;
    border-radius:8px;
    font-size:13px;
    color:white;
    text-align:center;
    white-space: nowrap;
}
.edit{background:#ffb300;}
.hapus{background:#e53935;}

/* MODAL */
.modal{
    position:fixed;
    inset:0;
    background:rgba(0,0,0,.45);
    display:none;
    align-items:center;
    justify-content:center;
    z-index:2000;
}
.modal-box{
    background:white;
    width:360px;
    padding:26px;
    border-radius:18px;
    text-align:center;
}
.modal-action{
    margin-top:22px;
    display:flex;
    justify-content:center;
    gap:12px;
}
.btn-batal{
    padding:10px 18px;
    background:#b0bec5;
    color:white;
    border:none;
    border-radius:10px;
    cursor:pointer;
}
.btn-hapus{
    padding:10px 18px;
    background:#e53935;
    color:white;
    border-radius:10px;
    text-decoration:none;
    cursor:pointer;
}

/* FOOTER */
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

<div class="header">
    <h1>Esa Unggul Hospital</h1>
    <span>Sistem Informasi Pendaftaran Pasien</span>
</div>

<div class="navbar">
    <a href="index.php">Dashboard</a>
    <a href="daftar_pasien.php">Daftar Pasien</a>
    <a href="data_pasien.php">Data Pasien</a>
</div>

<div class="container">
<div class="box">
<h2>Data Pasien</h2>
<p>Daftar seluruh pasien terdaftar</p>

<form class="search" method="get">
    <input name="q" placeholder="Cari No RM / Nama / NIK" value="<?= htmlspecialchars($q) ?>">
    <button>Cari</button>
</form>

<table>
<tr>
    <th>No RM</th>
    <th>Nama</th>
    <th>NIK</th>
    <th>No HP</th>
    <th>Jenis Kelamin</th>
    <th>Agama</th>
    <th>Pembiayaan</th>
    <th>Alamat</th>
    <th>Tanggal Daftar</th>
    <th>Aksi</th>
</tr>

<?php if(mysqli_num_rows($data) > 0): ?>
    <?php while($p=mysqli_fetch_assoc($data)): ?>
    <tr class="data-row" onclick="window.location='resume_medis.php?id=<?= $p['id'] ?>'">
        <td><?= htmlspecialchars($p['no_rm']) ?></td>
        <td><?= htmlspecialchars($p['nama']) ?></td>
        <td><?= htmlspecialchars($p['nik']) ?></td>
        <td><?= htmlspecialchars($p['no_hp']) ?></td>
        <td><span class="badge <?= str_replace(' ','\\ ',$p['jk']) ?>"><?= htmlspecialchars($p['jk']) ?></span></td>
        <td><?= htmlspecialchars($p['agama']) ?></td>
        <td><?= htmlspecialchars($p['jenis_pembiayaan']) ?></td>
        <td><?= htmlspecialchars($p['alamat']) ?><br>
            <?= htmlspecialchars($p['kelurahan']) ?>, <?= htmlspecialchars($p['kecamatan']) ?>, <?= htmlspecialchars($p['kota']) ?> - <?= htmlspecialchars($p['provinsi']) ?>
        </td>
        <td><?= date('d-m-Y', strtotime($p['created_at'])) ?></td>
        <td onclick="event.stopPropagation()">
            <div class="action">
                <a class="edit" href="edit_pasien.php?id=<?= $p['id'] ?>">Edit</a>
                <a class="hapus" href="#" onclick="openModal(<?= $p['id'] ?>)">Hapus</a>
            </div>
        </td>
    </tr>
    <?php endwhile; ?>
<?php else: ?>
<tr><td colspan="10" style="text-align:center;">Data pasien tidak ditemukan.</td></tr>
<?php endif; ?>
</table>

</div>
</div>

<!-- MODAL HAPUS -->
<div class="modal" id="modalHapus">
    <div class="modal-box">
        <h3>⚠️ Konfirmasi Hapus</h3>
        <p>Apakah Anda yakin ingin menghapus data pasien ini?</p>
        <div class="modal-action">
            <button class="btn-batal" onclick="closeModal()">Batal</button>
            <a id="btnHapus" class="btn-hapus">Ya, Hapus</a>
        </div>
    </div>
</div>

<div class="footer">
    © <?= date('Y') ?> Esa Unggul Hospital | All Rights Reserved
</div>

<script>
function openModal(id){
    document.getElementById('modalHapus').style.display='flex';
    document.getElementById('btnHapus').href='hapus_pasien.php?id='+id;
}
function closeModal(){
    document.getElementById('modalHapus').style.display='none';
}
</script>

</body>
</html>
