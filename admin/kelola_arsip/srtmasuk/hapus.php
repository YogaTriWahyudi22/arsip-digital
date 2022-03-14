<?php
include '../../../koneksi.php';
session_start();

if(isset($_GET['id'])){

    // Menghapus Data Database MySQL
    $del = $conn->prepare("DELETE FROM surat_masuk WHERE id_surat_masuk = '$_GET[id]'");
    $del->execute();

    header("Location:index.php");
}

?>