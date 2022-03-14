<?php
include '../../../koneksi.php';
session_start();
    if(isset($_POST['submit'])){
        $asal = $_POST['asal_surat'];
        $tanggal = $_POST['tanggal_surat'];
        $nomor = $_POST['nomor_surat'];
        $lampiran = $_POST['lampiran_surat'];
        $perihal = $_POST['perihal'];
        $pname = rand(1000,10000)."-".$_FILES['file']['name'];
        $tname = $_FILES['file']['tmp_name'];
        $upload_dir = '../../../img/gambar_surat';
        if ($_FILES['file']['name']==""){
            // Menambahkan Data Database MySQL
            $insert = $conn->prepare("INSERT INTO surat_masuk(asal_surat,tanggal_surat,nomor_surat,lampiran_surat,perihal) VALUES
            ('$asal','$tanggal','$nomor','$lampiran','$perihal')");
            $insert->execute();
        } else {
            // Menambahkan Data Database MySQL
            $insert = $conn->prepare("INSERT INTO surat_masuk(asal_surat,tanggal_surat,nomor_surat,lampiran_surat,perihal,gambar) VALUES
            ('$asal','$tanggal','$nomor','$lampiran','$perihal','$pname')");
            $insert->execute();

            move_uploaded_file($tname,$upload_dir."/".$pname);
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