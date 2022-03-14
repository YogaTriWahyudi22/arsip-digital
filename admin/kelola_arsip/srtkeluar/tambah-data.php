<?php
include '../../../koneksi.php';
session_start();
    if(isset($_POST['submit'])){
        $nomor = $_POST['nomor_surat'];
        $tanggal = $_POST['tanggal_surat'];
        $lampiran = $_POST['lampiran_surat'];
        $perihal = $_POST['perihal'];
        $tujuan = $_POST['tujuan_surat'];
        $tandatgn = $_POST['yg_bertandatgn'];
        $pname = rand(1000,10000)."-".$_FILES['file']['name'];
        $tname = $_FILES['file']['tmp_name'];
        $upload_dir = '../../../img/gambar_surat/';

        if ($_FILES['file']['name']==""){
            // Menambahkan Data Database MySQL
            $insert = $conn->prepare("INSERT INTO surat_keluar(nomor_surat,tanggal_surat,lampiran_surat,perihal,tujuan_surat,yg_bertandatgn) VALUES
            ('$nomor','$tanggal','$lampiran','$perihal','$tujuan','$tandatgn')");
            $insert->execute();
        } else {
            // Menambahkan Data Database MySQL
            $insert = $conn->prepare("INSERT INTO surat_keluar(nomor_surat,tanggal_surat,lampiran_surat,perihal,tujuan_surat,yg_bertandatgn,gambar) VALUES
            ('$nomor','$tanggal','$lampiran','$perihal','$tujuan','$tandatgn','$pname')");
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
    } else if(isset($_POST['back'])){
        ?>
        <script language="JavaScript">
            {
                javascript:history.back();
            }
        </script> <?php
    }
?>