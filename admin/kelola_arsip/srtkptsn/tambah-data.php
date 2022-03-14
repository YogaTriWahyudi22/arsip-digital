<?php
include '../../../koneksi.php';
session_start();
    if(isset($_POST['submit'])){
        $nomor = $_POST['nomor_surat'];
        $tentang = $_POST['tentang'];
        $tanggal = $_POST['tanggal_surat'];
        $tandatgn = $_POST['yg_bertandatgn'];
        $lampiran = $_POST['lampiran_surat'];
        
        $pname = rand(1000,10000)."-".$_FILES['file']['name'];
        $tname = $_FILES['file']['tmp_name'];
        $upload_dir = '../../../img/gambar_surat/';

        if ($_FILES['file']['name']==""){
            // Menambahkan Data Database MySQL
            $insert = $conn->prepare("INSERT INTO 
            surat_keputusan(nomor_surat_keputusan,tentang,tanggal_surat,yg_bertandatgn,lampiran)
            VALUES
            ('$nomor','$tentang','$tanggal','$tandatgn','$lampiran')");
            $insert->execute();
        } else {
            // Menambahkan Data Database MySQL
            $insert = $conn->prepare("INSERT INTO 
            surat_keputusan(nomor_surat_keputusan,tentang,tanggal_surat,yg_bertandatgn,lampiran,gambar)
            VALUES
            ('$nomor','$tentang','$tanggal','$tandatgn','$lampiran','$pname')");
            $insert->execute();

            move_uploaded_file($tname,$upload_dir.'/'.$pname);
        }
        if($insert){
            echo"<script language=JavaScript>
            alert('Data Berhasil Ditambahkan!');
            window.location.href='index.php';
            </script>";
        } else {
            echo"<script language=JavaScript>
            alert('Data Gagal Ditambahkan!');
            window.location.href='tambah.php';
            </script>";
        }
    }
?>