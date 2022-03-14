<?php
include '../../koneksi.php';
session_start();

if(isset($_GET['id'])){

    // Menghapus Data Database MySQL
    $del = $conn->prepare("DELETE FROM jenis_keterangan WHERE id_jenis_keterangan = '$_GET[id]'");
    $del->execute();

    header("Location:index.php");
}

?>