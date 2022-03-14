<?php
include '../../../koneksi.php';
session_start();

// Pengambilan Data dari Database MySQL
$sql = $conn->prepare("SELECT * FROM surat_keterangan WHERE id_surat_keterangan = '$_GET[id]'");
$sql->execute();
$data = $sql->fetch();

// Pengambilan Data dari Database MySQL
$sql = $conn->prepare("SELECT * FROM jenis_keterangan WHERE id_jenis_keterangan = '$data[id_jenis_keterangan]'");
$sql->execute();
$sqli = $sql->fetch();

if(isset($_GET['id'])){

    // Menghapus Data Database MySQL
    $del = $conn->prepare("DELETE FROM surat_keterangan WHERE id_surat_keterangan = '$_GET[id]'");
    $del->execute();

    header("Location:data.php?id=".$sqli['id_jenis_keterangan']."");
}

?>