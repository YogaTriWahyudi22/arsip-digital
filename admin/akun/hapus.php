<?php
include '../../koneksi.php';
session_start();

if(isset($_GET['id'])){
    // Pengambilan Data dari Database MySQL
    $sql = $conn->prepare("SELECT * FROM user WHERE id_user = '$_GET[id]'");
    $sql->execute();
    $esql = $sql->fetch();

    if($esql['status'] == 1){
        //Menghapus Data Database MySQL
        $dell = $conn->prepare("DELETE FROM admin WHERE username = '$esql[username]'");
        $dell->execute();
    } else if($esql['status'] == 2){
        //Menghapus Data Database MySQL
        $dell = $conn->prepare("DELETE FROM pegawai WHERE username = '$esql[username]'");
        $dell->execute();
    } else if($esql['status'] == 3){
        //Menghapus Data Database MySQL
        $dell = $conn->prepare("DELETE FROM kepala_kantor WHERE username = '$esql[username]'");
        $dell->execute();
    }

    $del = $conn->prepare("DELETE FROM user WHERE id_user = '$_GET[id]'");
    $del->execute();

    header("Location:index.php");
}

?>