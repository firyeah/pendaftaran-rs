<?php
include "koneksi.php";

/* ================= DATA DASHBOARD ================= */
$total = mysqli_fetch_assoc(mysqli_query($conn,"SELECT COUNT(*) t FROM pasien"))['t'];
$hari  = mysqli_fetch_assoc(mysqli_query($conn,"SELECT COUNT(*) t FROM pasien WHERE DATE(created_at)=CURDATE()"))['t'];

$baru = $hari;
$lama = $total - $hari;
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Dashboard - Esa Unggul Hospital</title>

<style>
/* ================= RESET ================= */
*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:Arial, sans-serif;
}
body{
    background:#f4f6f8;
    animation:fade .6s ease;
}
@keyframes fade{
    from{opacity:0;transform:translateY(12px)}
    to{opacity:1;transform:none}
}

/* ================= HEADER ================= */
.header{
    background:linear-gradient(135deg,#0d47a1,#1565c0);
    color:white;
    padding:22px 30px;
}
.header h1{font-size:26px}
.header span{font-size:14px;opacity:.9}

/* ================= NAVBAR ================= */
.navbar{
    position:sticky;
    top:0;
    z-index:999;
    background:white;
    box-shadow:0 6px 18px rgba(0,0,0,.1);
}
.nav{
    display:flex;
    gap:35px;
    padding:16px 30px;
    position:relative;
}
.nav a{
    text-decoration:none;
    font-weight:bold;
    color:#0d47a1;
    padding-bottom:6px;
}

/* GARIS ANIMASI */
.nav-line{
    position:absolute;
    bottom:10px;
    height:3px;
    background:#0d47a1;
    width:0;
    left:0;
    border-radius:4px;
    transition:.35s cubic-bezier(.4,0,.2,1);
}

/* ================= CONTENT ================= */
.container{padding:30px}
.container h2{margin-bottom:5px}
.container p{color:#555;margin-bottom:25px}

/* ================= DASHBOARD CARD ================= */
.dashboard{
    display:grid;
    grid-template-columns:repeat(4,1fr);
    gap:20px;
}
.card{
    padding:22px;
    border-radius:18px;
    color:white;
    box-shadow:0 12px 24px rgba(0,0,0,.18);
    transition:.4s cubic-bezier(.4,0,.2,1);
}
.card:hover{transform:translateY(-8px)}
.card h1{font-size:40px;margin-top:12px}

.blue{background:linear-gradient(135deg,#2196f3,#1e88e5)}
.green{background:linear-gradient(135deg,#4caf50,#43a047)}
.yellow{background:linear-gradient(135deg,#ffb300,#ffa000)}
.purple{background:linear-gradient(135deg,#9c27b0,#8e24aa)}

/* ================= BOX ================= */
.box{
    margin-top:35px;
    background:white;
    padding:28px;
    border-radius:18px;
    box-shadow:0 8px 20px rgba(0,0,0,.12);
}

/* ================= FOOTER ================= */
.footer{
    margin-top:50px;
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
    <div class="nav" id="nav">
        <a href="index.php">Dashboard</a>
        <a href="daftar_pasien.php">Daftar Pasien</a>
        <a href="data_pasien.php">Data Pasien</a>
        <div class="nav-line" id="navLine"></div>
    </div>
</div>

<!-- CONTENT -->
<div class="container">
    <h2>Dashboard</h2>
    <p>Ringkasan data pendaftaran pasien</p>

    <!-- CARD -->
    <div class="dashboard">
        <div class="card blue">Total Pasien<h1><?= $total ?></h1></div>
        <div class="card green">Hari Ini<h1><?= $hari ?></h1></div>
        <div class="card yellow">Pasien Baru<h1><?= $baru ?></h1></div>
        <div class="card purple">Pasien Lama<h1><?= $lama ?></h1></div>
    </div>

    <!-- GRAFIK -->
    <div class="box">
        <h3>Statistik Pasien</h3><br>
        <canvas id="grafik" height="110"></canvas>
    </div>
</div>

<!-- FOOTER -->
<div class="footer">
    © <?= date('Y') ?> Esa Unggul Hospital
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
/* ================= GRAFIK 4 WARNA ================= */
new Chart(document.getElementById('grafik'),{
    type:'bar',
    data:{
        labels:[
            'Total Pasien',
            'Hari Ini',
            'Pasien Baru',
            'Pasien Lama'
        ],
        datasets:[{
            data:[
                <?= $total ?>,
                <?= $hari ?>,
                <?= $baru ?>,
                <?= $lama ?>
            ],
            backgroundColor:[
                '#1e88e5',
                '#4caf50',
                '#ffb300',
                '#9c27b0'
            ],
            borderRadius:12
        }]
    },
    options:{
        plugins:{
            legend:{display:false}
        },
        animation:{
            duration:1500,
            easing:'easeOutQuart'
        },
        scales:{
            y:{
                beginAtZero:true,
                ticks:{stepSize:1}
            }
        }
    }
});

/* ================= NAVBAR GARIS GESER ================= */
const links=document.querySelectorAll('.nav a');
const line=document.getElementById('navLine');

links.forEach(link=>{
    link.addEventListener('mouseenter',()=>{
        const rect=link.getBoundingClientRect();
        const navRect=link.parentElement.getBoundingClientRect();
        line.style.width=rect.width+'px';
        line.style.left=(rect.left-navRect.left)+'px';
    });
});
document.querySelector('.nav').addEventListener('mouseleave',()=>{
    line.style.width=0;
});
</script>

</body>
</html>
