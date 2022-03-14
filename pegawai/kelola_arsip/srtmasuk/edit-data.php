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
            // Mengubah Data Database MySQL
            $insert = $conn->prepare("UPDATE surat_masuk SET
            asal_surat = '$asal',
            tanggal_surat = '$tanggal',
            nomor_surat = '$nomor',
            lampiran_surat = '$lampiran',
            perihal = '$perihal'
            WHERE id_surat_masuk = '$_GET[id]'");
            $insert->execute();

        } else {
            // Mengubah Data Database MySQL
            $insert = $conn->prepare("UPDATE surat_masuk SET
            asal_surat = '$asal',
            tanggal_surat = '$tanggal',
            nomor_surat = '$nomor',
            lampiran_surat = '$lampiran',
            perihal = '$perihal',
            gambar = '$pname'
            WHERE id_surat_masuk = '$_GET[id]'");
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