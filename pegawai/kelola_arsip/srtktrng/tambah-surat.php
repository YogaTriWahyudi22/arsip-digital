<?php
include '../../../koneksi.php';
session_start();
    if(isset($_POST['submit'])){
        $id_jenis = $_GET['id'];
        $nomor = $_POST['nomor_surat'];
        $pemohon = $_POST['pemohon'];
        $kkeluarga = $_POST['kepala_keluarga'];
        $tanggungan = $_POST['tanggungan'];
        $keperluan = $_POST['keperluan'];
        $tgl_surat = $_POST['tanggal_surat'];
        $tandatgn = $_POST['yg_bertandatgn'];
        $meninggal = $_POST['yg_meninggal'];
        $ket_meninggal = $_POST['keterangan_meninggal'];
        $ahli_waris = $_POST['ahli_waris'];

        $pname = rand(1000,10000)."-".$_FILES['file']['name'];
        $tname = $_FILES['file']['tmp_name'];
        $upload_dir = '../../../img/gambar_surat';
        
        if ($_FILES['file']['name']==""){
            // Menambahkan Data Database MySQL
            $insert = $conn->prepare("INSERT INTO
            surat_keterangan(id_jenis_keterangan,nomor_surat,pemohon,kepala_keluarga,tanggungan,keperluan,tanggal_surat,yg_bertandatgn,yg_meninggal,keterangan_meninggal,ahli_waris)
            VALUES
            ('$id_jenis','$nomor','$pemohon','$kkeluarga','$tanggungan','$keperluan','$tgl_surat','$tandatgn','$meninggal','$ket_meninggal','$ahli_waris')");
            $insert->execute();
        } else {
            // Menambahkan Data Database MySQL
            $insert = $conn->prepare("INSERT INTO
            surat_keterangan(id_jenis_keterangan,nomor_surat,pemohon,kepala_keluarga,tanggungan,keperluan,tanggal_surat,yg_bertandatgn,yg_meninggal,keterangan_meninggal,ahli_waris,gambar)
            VALUES
            ('$id_jenis','$nomor','$pemohon','$kkeluarga','$tanggungan','$keperluan','$tgl_surat','$tandatgn','$meninggal','$ket_meninggal','$ahli_waris','$pname')");
            $insert->execute();

            move_uploaded_file($tname,$upload_dir."/".$pname);
        }

        if($insert){
            echo"<script language=JavaScript>
            alert('Data Berhasil Ditambahkan!');
            window.location.href='index.php?id=".$_GET['id']."';
            </script>";
        } else {
            echo"<script language=JavaScript>
            alert('Data Gagal Ditambahkan!');
            window.location.href='tambah.php?id=".$_GET['id']."';
            </script>";
        }
    }
?>