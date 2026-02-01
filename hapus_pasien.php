<?php
include "koneksi.php";

if (!isset($_GET['id'])) {
    header("location:data_pasien.php");
    exit;
}

$id = intval($_GET['id']); // pengaman

mysqli_query($conn, "DELETE FROM pasien WHERE id='$id'");

header("location:data_pasien.php?msg=hapus_sukses");
exit;
