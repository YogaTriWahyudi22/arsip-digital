<?php
include '../../koneksi.php';
session_start();
setlocale(LC_ALL, 'id_ID.UTF8', 'id_ID.UTF-8', 'id_ID.8859-1', 'id_ID', 'IND.UTF8', 'IND.UTF-8', 'IND.8859-1', 'IND', 'Indonesian.UTF8', 'Indonesian.UTF-8', 'Indonesian.8859-1', 'Indonesian', 'Indonesia', 'id', 'ID', 'en_US.UTF8', 'en_US.UTF-8', 'en_US.8859-1', 'en_US', 'American', 'ENG', 'English');
date_default_timezone_set('Asia/Jakarta');

if($_GET['bulan'] == '01'){
    $bln = "Januari";
} else if($_GET['bulan'] == '02'){
    $bln = "Februari";
} else if($_GET['bulan'] == '03'){
    $bln = "Maret";
} else if($_GET['bulan'] == '04'){
    $bln = "April";
} else if($_GET['bulan'] == '05'){
    $bln = "Mei";
} else if($_GET['bulan'] == '06'){
    $bln = "Juni";
} else if($_GET['bulan'] == '07'){
    $bln = "Juli";
} else if($_GET['bulan'] == '08'){
    $bln = "Agustus";
} else if($_GET['bulan'] == '09'){
    $bln = "September";
} else if($_GET['bulan'] == '10'){
    $bln = "Oktober";
} else if($_GET['bulan'] == '11'){
    $bln = "November";
} else if($_GET['bulan'] == '12'){
    $bln = "Desember";
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="refresh" content="1; url=srtkeluar.php">
    <link rel="stylesheet" href="style/srtmasuk-print.css">
    <title>Laporan Keseluruhan Surat Keluar Tahun <?php echo $_GET['tahun'] ?> Bulan <?php echo $bln ?></title>
</head>
<body onload="window.print();">
    <div class="head">
        <img src="../../img/logo payakumbuh.png" class="logo">
        <div class="txt">
            <h2>PEMERINTAHAN KOTA PAYAKUMBUH</h2>
            <h1>KECAMATAN PAYAKUMBUH UTARA</h1>
            <h1>KELURAHAN KAPALO KOTO DIBALAI</h1>
            <p>NAGARI KOTO NAN GADANG</p>
            <p>Jl. H. Rasul No.Telp. (0752) 90781 - Kode Pos. 26211</p>
        </div>
    </div>
    <h1>Laporan Keseluruhan Surat Keluar<br>Tahun <?php echo $_GET['tahun'] ?> di Bulan <?php echo $bln ?></h1>
    <table class="tbl">
        <tr>
            <td width="20px">No.</td>
            <td width="150px">Tanggal Surat</td>
            <td>Pengirim</td>   
            <td>Perihal</td>
            <td>Gambar</td>
        </tr>
    <?php
        $no=1;
        // Pengambilan Data dari Database MySQL
        $sql = $conn->prepare("SELECT * FROM surat_keluar WHERE MONTH(tanggal_surat)='$_GET[bulan]'
        AND YEAR(tanggal_surat)='$_GET[tahun]'");
        $sql->execute();
        $select = $sql->fetchAll();
        // Perulangan(Looping) Data dari Database MySQL
        foreach($select as $value){ ?>
            <tr>
                <td><?php echo $no++; ?></td>
                <td><?php echo $value['tanggal_surat']; ?></td>
                <td><?php echo $value['tujuan_surat'] ?></td>
                <td><?php echo $value['perihal'] ?></td>
                <td class="img">
                    <?php
                        if(empty($value['gambar'])){
                            echo"Tidak Ada Gambar";
                        } else {
                    ?>
                    <a href="download.php?gambar=<?php echo $value['gambar'] ?>">
                    <embed src="../../img/gambar_surat/<?php echo $value['gambar'] ?>" title="Klik utk download">
                    </a>
                    <?php } ?>
                </td>
            </tr>
    <?php } ?>
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