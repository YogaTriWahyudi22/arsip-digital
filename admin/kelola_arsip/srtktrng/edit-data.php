<?php
include '../../../koneksi.php';
session_start();

// Pengambilan Data dari Database MySQL
$sql = $conn->prepare("SELECT * FROM surat_keterangan WHERE id_surat_keterangan = '$_GET[id]'");
$sql->execute();
$data = $sql->fetch();

// Pengambilan Data dari Database MySQL
$sql = $conn->prepare("SELECT * FROM jenis_keterangan WHERE id_jenis_keterangan = '$data[id_jenis_keterangan]'");
$sql->execute();
$sqli = $sql->fetch();

    if(isset($_POST['submit'])){
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
            // Mengubah Data Database MySQL
            $insert = $conn->prepare("UPDATE surat_keterangan SET
            nomor_surat = '$nomor',
            pemohon = '$pemohon',
            kepala_keluarga = '$kkeluarga',
            tanggungan = '$tanggungan',
            keperluan = '$keperluan',
            tanggal_surat = '$tgl_surat',
            yg_bertandatgn = '$tandatgn',
            yg_meninggal = '$meninggal',
            keterangan_meninggal = '$ket_meninggal',
            ahli_waris = '$ahli_waris'
            WHERE id_surat_keterangan = '$_GET[id]'");
            $insert->execute();

        } else {
            // Mengubah Data Database MySQL
            $insert = $conn->prepare("UPDATE surat_keterangan SET
            nomor_surat = '$nomor',
            pemohon = '$pemohon',
            kepala_keluarga = '$kkeluarga',
            tanggungan = '$tanggungan',
            keperluan = '$keperluan',
            tanggal_surat = '$tgl_surat',
            yg_bertandatgn = '$tandatgn',
            yg_meninggal = '$meninggal',
            keterangan_meninggal = '$ket_meninggal',
            ahli_waris = '$ahli_waris',
            gambar = '$pname'
            WHERE id_surat_keterangan = '$_GET[id]'");
            $insert->execute();

            move_uploaded_file($tname,$upload_dir."/".$pname);
        }

        if($insert){
            echo"<script language=JavaScript>
            alert('Data Berhasil Diubah!');
            window.location.href='data.php?id=".$sqli['id_jenis_keterangan']."';
            </script>";
        } else {
            echo"<script language=JavaScript>
            alert('Data Gagal Diubah!');
            window.location.href='edit.php?id=".$_GET['id']."';
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