<?php
include '../../koneksi.php';
session_start();
setlocale(LC_ALL, 'id_ID.UTF8', 'id_ID.UTF-8', 'id_ID.8859-1', 'id_ID', 'IND.UTF8', 'IND.UTF-8', 'IND.8859-1', 'IND', 'Indonesian.UTF8', 'Indonesian.UTF-8', 'Indonesian.8859-1', 'Indonesian', 'Indonesia', 'id', 'ID', 'en_US.UTF8', 'en_US.UTF-8', 'en_US.8859-1', 'en_US', 'American', 'ENG', 'English');
date_default_timezone_set('Asia/Jakarta');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="refresh" content="1; url=allsrt.php">
    <link rel="stylesheet" href="style/allsrt-print.css">
    <title>Laporan Keseluruhan Surat Tahun <?php echo date("Y") ?></title>
</head>
<body onload="window.print();">
    <div class="head">
        <img src="../../img/logo payakumbuh.png">
        <div class="txt">
            <h2>PEMERINTAHAN KOTA PAYAKUMBUH</h2>
            <h1>KECAMATAN PAYAKUMBUH UTARA</h1>
            <h1>KELURAHAN KAPALO KOTO DIBALAI</h1>
            <p>NAGARI KOTO NAN GADANG</p>
            <p>Jl. H. Rasul No.Telp. (0752) 90781 - Kode Pos. 26211</p>
        </div>
    </div>
    <h1>Laporan Keseluruhan Surat Tahun <?php echo date("Y") ?></h1>
    <table class="tbl">
            <tr>
                <td rowspan="2">Jenis Surat</td>
                <td colspan="12">Bulan</td>
                <td rowspan="2">Total</td>
            </tr>
            <tr>
                <td>Jan</td>
                <td>Feb</td>
                <td>Mar</td>
                <td>Apr</td>
                <td>May</td>
                <td>Jun</td>
                <td>Jul</td>
                <td>Aug</td>
                <td>Sep</td>
                <td>Oct</td>
                <td>Nov</td>
                <td>Dec</td>
            </tr>
    <?php
        // Penghitungan Data dari Database MySQL
        // Surat Masuk
        $jan = $conn->prepare("SELECT count(*) AS jan FROM surat_masuk WHERE MONTH(tanggal_surat) = '01'");
        $jan->execute();
        $jann = $jan->fetch();

        $feb = $conn->prepare("SELECT count(*) AS feb FROM surat_masuk WHERE MONTH(tanggal_surat) = '02'");
        $feb->execute();
        $febb = $feb->fetch();

        $mar = $conn->prepare("SELECT count(*) AS mar FROM surat_masuk WHERE MONTH(tanggal_surat) = '03'");
        $mar->execute();
        $marr = $mar->fetch();

        $apr = $conn->prepare("SELECT count(*) AS apr FROM surat_masuk WHERE MONTH(tanggal_surat) = '04'");
        $apr->execute();
        $aprr = $apr->fetch();

        $may = $conn->prepare("SELECT count(*) AS may FROM surat_masuk WHERE MONTH(tanggal_surat) = '05'");
        $may->execute();
        $mayy = $may->fetch();

        $jun = $conn->prepare("SELECT count(*) AS jun FROM surat_masuk WHERE MONTH(tanggal_surat) = '06'");
        $jun->execute();
        $junn = $jun->fetch();

        $jul = $conn->prepare("SELECT count(*) AS jul FROM surat_masuk WHERE MONTH(tanggal_surat) = '07'");
        $jul->execute();
        $jull = $jul->fetch();

        $aug = $conn->prepare("SELECT count(*) AS aug FROM surat_masuk WHERE MONTH(tanggal_surat) = '08'");
        $aug->execute();
        $augg = $aug->fetch();
        
        $sep = $conn->prepare("SELECT count(*) AS sep FROM surat_masuk WHERE MONTH(tanggal_surat) = '09'");
        $sep->execute();
        $sepp = $sep->fetch();

        $oct = $conn->prepare("SELECT count(*) AS oct FROM surat_masuk WHERE MONTH(tanggal_surat) = '10'");
        $oct->execute();
        $octt = $oct->fetch();

        $nov = $conn->prepare("SELECT count(*) AS nov FROM surat_masuk WHERE MONTH(tanggal_surat) = '11'");
        $nov->execute();
        $novv = $nov->fetch();

        $dec = $conn->prepare("SELECT count(*) AS december FROM surat_masuk WHERE MONTH(tanggal_surat) = '12'");
        $dec->execute();
        $decc = $dec->fetch();

        $total1 =$jann['jan']+$febb['feb']+$marr['mar']+$aprr['apr']+$mayy['may']+$junn['jun']+$jull['jul']+$augg['aug']+$sepp['sep']+$octt['oct']+$novv['nov']+$decc['december'];
        //Surat Masuk
    ?>
                                        <tr>
                                            <td>Surat Masuk</td>
                                            <td><?php echo $jann['jan'] ?></td>
                                            <td><?php echo $febb['feb'] ?></td>
                                            <td><?php echo $marr['mar'] ?></td>
                                            <td><?php echo $aprr['apr'] ?></td>
                                            <td><?php echo $mayy['may'] ?></td>
                                            <td><?php echo $junn['jun'] ?></td>
                                            <td><?php echo $jull['jul'] ?></td>
                                            <td><?php echo $augg['aug'] ?></td>
                                            <td><?php echo $sepp['sep'] ?></td>
                                            <td><?php echo $octt['oct'] ?></td>
                                            <td><?php echo $novv['nov'] ?></td>
                                            <td><?php echo $decc['december'] ?></td>
                                            <td><?php echo $total1 ?></td>
                                        </tr>
    <?php
        // Penghitungan Data dari Database MySQL
        //Surat Keluar
        $jan = $conn->prepare("SELECT count(*) AS jan FROM surat_keluar WHERE MONTH(tanggal_surat) = '01'");
        $jan->execute();
        $jann = $jan->fetch();

        $feb = $conn->prepare("SELECT count(*) AS feb FROM surat_keluar WHERE MONTH(tanggal_surat) = '02'");
        $feb->execute();
        $febb = $feb->fetch();

        $mar = $conn->prepare("SELECT count(*) AS mar FROM surat_keluar WHERE MONTH(tanggal_surat) = '03'");
        $mar->execute();
        $marr = $mar->fetch();

        $apr = $conn->prepare("SELECT count(*) AS apr FROM surat_keluar WHERE MONTH(tanggal_surat) = '04'");
        $apr->execute();
        $aprr = $apr->fetch();

        $may = $conn->prepare("SELECT count(*) AS may FROM surat_keluar WHERE MONTH(tanggal_surat) = '05'");
        $may->execute();
        $mayy = $may->fetch();

        $jun = $conn->prepare("SELECT count(*) AS jun FROM surat_keluar WHERE MONTH(tanggal_surat) = '06'");
        $jun->execute();
        $junn = $jun->fetch();

        $jul = $conn->prepare("SELECT count(*) AS jul FROM surat_keluar WHERE MONTH(tanggal_surat) = '07'");
        $jul->execute();
        $jull = $jul->fetch();

        $aug = $conn->prepare("SELECT count(*) AS aug FROM surat_keluar WHERE MONTH(tanggal_surat) = '08'");
        $aug->execute();
        $augg = $aug->fetch();
        
        $sep = $conn->prepare("SELECT count(*) AS sep FROM surat_keluar WHERE MONTH(tanggal_surat) = '09'");
        $sep->execute();
        $sepp = $sep->fetch();

        $oct = $conn->prepare("SELECT count(*) AS oct FROM surat_keluar WHERE MONTH(tanggal_surat) = '10'");
        $oct->execute();
        $octt = $oct->fetch();

        $nov = $conn->prepare("SELECT count(*) AS nov FROM surat_keluar WHERE MONTH(tanggal_surat) = '11'");
        $nov->execute();
        $novv = $nov->fetch();

        $dec = $conn->prepare("SELECT count(*) AS december FROM surat_keluar WHERE MONTH(tanggal_surat) = '12'");
        $dec->execute();
        $decc = $dec->fetch();

        $total2 =$jann['jan']+$febb['feb']+$marr['mar']+$aprr['apr']+$mayy['may']+$junn['jun']+$jull['jul']+$augg['aug']+$sepp['sep']+$octt['oct']+$novv['nov']+$decc['december'];
        //Surat Keluar
    ?>
                                        <tr>
                                            <td>Surat Keluar</td>
                                            <td><?php echo $jann['jan'] ?></td>
                                            <td><?php echo $febb['feb'] ?></td>
                                            <td><?php echo $marr['mar'] ?></td>
                                            <td><?php echo $aprr['apr'] ?></td>
                                            <td><?php echo $mayy['may'] ?></td>
                                            <td><?php echo $junn['jun'] ?></td>
                                            <td><?php echo $jull['jul'] ?></td>
                                            <td><?php echo $augg['aug'] ?></td>
                                            <td><?php echo $sepp['sep'] ?></td>
                                            <td><?php echo $octt['oct'] ?></td>
                                            <td><?php echo $novv['nov'] ?></td>
                                            <td><?php echo $decc['december'] ?></td>
                                            <td><?php echo $total2 ?></td>
                                        </tr>
    <?php
        // Penghitungan Data dari Database MySQL
        //Surat Keterangan
        $jan = $conn->prepare("SELECT count(*) AS jan FROM surat_keterangan WHERE MONTH(tanggal_surat) = '01'");
        $jan->execute();
        $jann = $jan->fetch();

        $feb = $conn->prepare("SELECT count(*) AS feb FROM surat_keterangan WHERE MONTH(tanggal_surat) = '02'");
        $feb->execute();
        $febb = $feb->fetch();

        $mar = $conn->prepare("SELECT count(*) AS mar FROM surat_keterangan WHERE MONTH(tanggal_surat) = '03'");
        $mar->execute();
        $marr = $mar->fetch();

        $apr = $conn->prepare("SELECT count(*) AS apr FROM surat_keterangan WHERE MONTH(tanggal_surat) = '04'");
        $apr->execute();
        $aprr = $apr->fetch();

        $may = $conn->prepare("SELECT count(*) AS may FROM surat_keterangan WHERE MONTH(tanggal_surat) = '05'");
        $may->execute();
        $mayy = $may->fetch();

        $jun = $conn->prepare("SELECT count(*) AS jun FROM surat_keterangan WHERE MONTH(tanggal_surat) = '06'");
        $jun->execute();
        $junn = $jun->fetch();

        $jul = $conn->prepare("SELECT count(*) AS jul FROM surat_keterangan WHERE MONTH(tanggal_surat) = '07'");
        $jul->execute();
        $jull = $jul->fetch();

        $aug = $conn->prepare("SELECT count(*) AS aug FROM surat_keterangan WHERE MONTH(tanggal_surat) = '08'");
        $aug->execute();
        $augg = $aug->fetch();
        
        $sep = $conn->prepare("SELECT count(*) AS sep FROM surat_keterangan WHERE MONTH(tanggal_surat) = '09'");
        $sep->execute();
        $sepp = $sep->fetch();

        $oct = $conn->prepare("SELECT count(*) AS oct FROM surat_keterangan WHERE MONTH(tanggal_surat) = '10'");
        $oct->execute();
        $octt = $oct->fetch();

        $nov = $conn->prepare("SELECT count(*) AS nov FROM surat_keterangan WHERE MONTH(tanggal_surat) = '11'");
        $nov->execute();
        $novv = $nov->fetch();

        $dec = $conn->prepare("SELECT count(*) AS december FROM surat_keterangan WHERE MONTH(tanggal_surat) = '12'");
        $dec->execute();
        $decc = $dec->fetch();

        $total3 =$jann['jan']+$febb['feb']+$marr['mar']+$aprr['apr']+$mayy['may']+$junn['jun']+$jull['jul']+$augg['aug']+$sepp['sep']+$octt['oct']+$novv['nov']+$decc['december'];
        //Surat Keterangan
    ?>
                                        <tr>
                                            <td>Surat Keterangan</td>
                                            <td><?php echo $jann['jan'] ?></td>
                                            <td><?php echo $febb['feb'] ?></td>
                                            <td><?php echo $marr['mar'] ?></td>
                                            <td><?php echo $aprr['apr'] ?></td>
                                            <td><?php echo $mayy['may'] ?></td>
                                            <td><?php echo $junn['jun'] ?></td>
                                            <td><?php echo $jull['jul'] ?></td>
                                            <td><?php echo $augg['aug'] ?></td>
                                            <td><?php echo $sepp['sep'] ?></td>
                                            <td><?php echo $octt['oct'] ?></td>
                                            <td><?php echo $novv['nov'] ?></td>
                                            <td><?php echo $decc['december'] ?></td>
                                            <td><?php echo $total3 ?></td>
                                        </tr>
    <?php
        // Penghitungan Data dari Database MySQL
        //Surat Keputusan
        $jan = $conn->prepare("SELECT count(*) AS jan FROM surat_keputusan WHERE MONTH(tanggal_surat) = '01'");
        $jan->execute();
        $jann = $jan->fetch();

        $feb = $conn->prepare("SELECT count(*) AS feb FROM surat_keputusan WHERE MONTH(tanggal_surat) = '02'");
        $feb->execute();
        $febb = $feb->fetch();

        $mar = $conn->prepare("SELECT count(*) AS mar FROM surat_keputusan WHERE MONTH(tanggal_surat) = '03'");
        $mar->execute();
        $marr = $mar->fetch();

        $apr = $conn->prepare("SELECT count(*) AS apr FROM surat_keputusan WHERE MONTH(tanggal_surat) = '04'");
        $apr->execute();
        $aprr = $apr->fetch();

        $may = $conn->prepare("SELECT count(*) AS may FROM surat_keputusan WHERE MONTH(tanggal_surat) = '05'");
        $may->execute();
        $mayy = $may->fetch();

        $jun = $conn->prepare("SELECT count(*) AS jun FROM surat_keputusan WHERE MONTH(tanggal_surat) = '06'");
        $jun->execute();
        $junn = $jun->fetch();

        $jul = $conn->prepare("SELECT count(*) AS jul FROM surat_keputusan WHERE MONTH(tanggal_surat) = '07'");
        $jul->execute();
        $jull = $jul->fetch();

        $aug = $conn->prepare("SELECT count(*) AS aug FROM surat_keputusan WHERE MONTH(tanggal_surat) = '08'");
        $aug->execute();
        $augg = $aug->fetch();
        
        $sep = $conn->prepare("SELECT count(*) AS sep FROM surat_keputusan WHERE MONTH(tanggal_surat) = '09'");
        $sep->execute();
        $sepp = $sep->fetch();

        $oct = $conn->prepare("SELECT count(*) AS oct FROM surat_keputusan WHERE MONTH(tanggal_surat) = '10'");
        $oct->execute();
        $octt = $oct->fetch();

        $nov = $conn->prepare("SELECT count(*) AS nov FROM surat_keputusan WHERE MONTH(tanggal_surat) = '11'");
        $nov->execute();
        $novv = $nov->fetch();

        $dec = $conn->prepare("SELECT count(*) AS december FROM surat_keputusan WHERE MONTH(tanggal_surat) = '12'");
        $dec->execute();
        $decc = $dec->fetch();

        $total4 =$jann['jan']+$febb['feb']+$marr['mar']+$aprr['apr']+$mayy['may']+$junn['jun']+$jull['jul']+$augg['aug']+$sepp['sep']+$octt['oct']+$novv['nov']+$decc['december'];
        //Surat Keputusan
    ?>
                                        <tr>
                                            <td>Surat Keputusan</td>
                                            <td><?php echo $jann['jan'] ?></td>
                                            <td><?php echo $febb['feb'] ?></td>
                                            <td><?php echo $marr['mar'] ?></td>
                                            <td><?php echo $aprr['apr'] ?></td>
                                            <td><?php echo $mayy['may'] ?></td>
                                            <td><?php echo $junn['jun'] ?></td>
                                            <td><?php echo $jull['jul'] ?></td>
                                            <td><?php echo $augg['aug'] ?></td>
                                            <td><?php echo $sepp['sep'] ?></td>
                                            <td><?php echo $octt['oct'] ?></td>
                                            <td><?php echo $novv['nov'] ?></td>
                                            <td><?php echo $decc['december'] ?></td>
                                            <td><?php echo $total4 ?></td>
                                        </tr>
    </table>

    <table class="teble">
        <tr>
            <td>Payakumbuh, <?php
                                $date = strftime('%d %B %Y');
                                echo $date;
                            ?></td>
        </tr>
        <tr>
            <td><b>LURAH<b></td>
        </tr>
        <tr>
            <td></td>
        </tr>
        <tr>
            <td><b><?php
                $kep = $conn->prepare('SELECT * FROM kepala_kantor WHERE id_jabatan = 2');
                $kep->execute();
                $kepp = $kep->fetch();
                echo $kepp['nama_lengkap'];
            ?><b></td>
        </tr>
        <tr>
            <td>NIP: <?php echo $kepp['nip'] ?></td>
        </tr>
    </table>
</body>
</html>