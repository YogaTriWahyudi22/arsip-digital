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
            // Mengubah Data Database MySQL
            $insert = $conn->prepare("UPDATE surat_keputusan SET
            nomor_surat_keputusan = '$nomor',
            tentang = '$tentang',
            tanggal_surat = '$tanggal',
            yg_bertandatgn = '$tandatgn',
            lampiran = '$lampiran'
            WHERE id_surat_keputusan = '$_GET[id]'");
            $insert->execute();

        } else {
            // Mengubah Data Database MySQL
            $insert = $conn->prepare("UPDATE surat_keputusan SET
            nomor_surat_keputusan = '$nomor',
            tentang = '$tentang',
            tanggal_surat = '$tanggal',
            yg_bertandatgn = '$tandatgn',
            lampiran = '$lampiran',
            gambar = '$pname'
            WHERE id_surat_keputusan = '$_GET[id]'");
            $insert->execute();

            move_uploaded_file($tname,$upload_dir."/".$pname);
        }

        if($insert){
            echo"<script language=JavaScript>
            alert('Data Berhasil Diubah!');
            window.location.href='index.php';
            </script>";
        } else {
            echo"<script language=JavaScript>
            alert('Data Gagal Diubah!');
            window.location.href='index.php';
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