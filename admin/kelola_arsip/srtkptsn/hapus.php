<?php
include '../../../koneksi.php';
session_start();

if(isset($_GET['id'])){

    // Menghapus Data Database MySQL
    $del = $conn->prepare("DELETE FROM surat_keputusan WHERE id_surat_keputusan = '$_GET[id]'");
    $del->execute();

    header("Location:index.php");
}

?>