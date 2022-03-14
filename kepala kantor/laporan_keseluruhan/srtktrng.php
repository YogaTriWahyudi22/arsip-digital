<?php
include '../../koneksi.php';
session_start();

// Pengambilan Data dari Database MySQL
$use = $conn->prepare("SELECT * FROM kepala_kantor WHERE username='$_SESSION[username]'");
$use->execute();
$user = $use->fetch();

// Pengambilan Data dari Database MySQL
$usee = $conn->prepare("SELECT * FROM user WHERE username='$_SESSION[username]'");
$usee->execute();
$useer = $usee->fetch();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/srtktrng.css">
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <title>Laporan Keseluruhan Surat - Arsip Digital (Kepala Kantor)</title>
</head>
<body>
    <div class="sidebar">
        <div class="logo-content">
            <div class="logo">
            <i class='bx bx-archive'></i>
                <div class="logo-name">Arsip Digital</div>
            </div>
            <i class='bx bx-menu' id="btn"></i>
        </div>
        <ul class="nav-list">
            <li>
                <a href="../index.php">
                <i class='bx bxs-dashboard'></i>
                    <span class="links_name">Dashboard</span>
                </a>
                <span class="tooltip">Dashboard</span>
            </li>
            <li class="active" onclick="drop()">
                <label>
                    <i class='bx bx-file-find'></i>
                    <span class=links_name>Laporan Keseluruhan<i class='bx bx-caret-down'></i></span>
                </label>
                <span class=tooltip>Laporan Keseluruhan</span>
            </li>
            <div class="drop">
            <li>
                <a href='../laporan_keseluruhan/allsrt.php'>
                    <i class='bx bx-dots-vertical-rounded'></i>
                    <span class=links_name>Seluruh Surat</span>
                </a>
            </li>
            <li class="active">
                <a href='../laporan_keseluruhan/srtktrng.php'>
                    <i class='bx bx-dots-vertical-rounded'></i>
                    <span class=links_name>Surat Keterangan</span>
                </a>
            </li>
            </div>
            <li onclick="dropp()" class="a">
                <label>
                    <i class='bx bx-file'></i>
                    <span class=links_name>Laporan Surat<i class='bx bx-caret-down'></i></span>
                </label>
                <span class=tooltip>Laporan Surat</span>
            </li>
            <div class="dropp">
            <li>
                <a href='../laporan/srtmasuk.php'>
                    <i class='bx bx-dots-vertical-rounded'></i>
                    <span class=links_name>Surat Masuk</span>
                </a>
            </li>
            <li>
                <a href='../laporan/srtkeluar.php'>
                    <i class='bx bx-dots-vertical-rounded'></i>
                    <span class=links_name>Surat Keluar</span>
                </a>
            </li>
            <li>
                <a href='../laporan/srtktrng.php'>
                    <i class='bx bx-dots-vertical-rounded'></i>
                    <span class=links_name>Surat Keterangan</span>
                </a>
            </li>
            <li>
                <a href='../laporan/srtkptsn.php'>
                    <i class='bx bx-dots-vertical-rounded'></i>
                    <span class=links_name>Surat Keputusan</span>
                </a>
            </li>
            </div>
        </ul>
        <div class="copyright">
            <p>2022 Arsip Digital</p>
        </div>
    </div>

    <div class="main-content">
        <header>
            <h2>
                Laporan Keseluruhan Surat Keterangan
            </h2>
            <div class="user">
                <img src="../../img/pp.jpg" width="40px" height="40px" alt="">
                <div>
                    <h4>
                    <?php
                        echo"$user[nama_lengkap]";
                    ?>
                    </h4>
                    <small>Kepala Kantor</small>
                </div>
                <div class="logout">
                <a href="../../logout.php"><i class='bx bx-log-out' id="logout"></i></a>
                </div>
            </div>
        </header>

        <main>
            <div class="table">
                <div class="data">
                        <div class="card">
                            <div class="card-header">
                                <h3>
                                    Data Keseluruhan Surat Keterangan Tahun <?php echo date("Y") ?>
                                </h3>
                                <a href="srtktrng-print.php">
                                <label name="back" class="btnnn">Print
                                <span class='bx bxs-printer'></span></label></a>
                            </div>
                            
                            <div class="card-body">
                                <div class="table-responsive">
                                <table width="100%">
                                    <form action="" method="post">
                                    <thead>
                                        <tr>
                                            <td width="20px" rowspan="2">No.</td>
                                            <td rowspan="2">Jenis Surat Keterangan</td>
                                            <td colspan="12">Bulan</td>
                                            <td rowspan="2">Total</td>
                                        </tr>
                                        <tr>
                                            <td width="20px">Jan</td>
                                            <td width="20px">Feb</td>
                                            <td width="20px">Mar</td>
                                            <td width="20px">Apr</td>
                                            <td width="20px">May</td>
                                            <td width="20px">Jun</td>
                                            <td width="20px">Jul</td>
                                            <td width="20px">Aug</td>
                                            <td width="20px">Sep</td>
                                            <td width="20px">Oct</td>
                                            <td width="20px">Nov</td>
                                            <td width="20px">Dec</td>
                                        </tr>
                                    </thead></form>
                                    <tbody>
    <?php
        $no = 1;
        // Pengambilan Data dari Database MySQL
        $jens = $conn->prepare("SELECT * FROM jenis_keterangan");
        $jens->execute();
        $jenis= $jens->fetchAll();

        // Perulangan(Looping) Data dari Database MySQL
        foreach ($jenis as $row) {
            // Penghitungan Data dari Database MySQL
            $jan = $conn->prepare("SELECT count(*) AS jan FROM surat_keterangan WHERE id_jenis_keterangan='$row[id_jenis_keterangan]'
            AND MONTH(tanggal_surat) = '01'");
            $jan->execute();
            $jann = $jan->fetch();

            $feb = $conn->prepare("SELECT count(*) AS feb FROM surat_keterangan WHERE id_jenis_keterangan='$row[id_jenis_keterangan]'
            AND MONTH(tanggal_surat) = '02'");
            $feb->execute();
            $febb = $feb->fetch();

            $mar = $conn->prepare("SELECT count(*) AS mar FROM surat_keterangan WHERE id_jenis_keterangan='$row[id_jenis_keterangan]'
            AND MONTH(tanggal_surat) = '03'");
            $mar->execute();
            $marr = $mar->fetch();

            $apr = $conn->prepare("SELECT count(*) AS apr FROM surat_keterangan WHERE id_jenis_keterangan='$row[id_jenis_keterangan]'
            AND MONTH(tanggal_surat) = '04'");
            $apr->execute();
            $aprr = $apr->fetch();

            $may = $conn->prepare("SELECT count(*) AS may FROM surat_keterangan WHERE id_jenis_keterangan='$row[id_jenis_keterangan]'
            AND MONTH(tanggal_surat) = '05'");
            $may->execute();
            $mayy = $may->fetch();

            $jun = $conn->prepare("SELECT count(*) AS jun FROM surat_keterangan WHERE id_jenis_keterangan='$row[id_jenis_keterangan]'
            AND MONTH(tanggal_surat) = '06'");
            $jun->execute();
            $junn = $jun->fetch();

            $jul = $conn->prepare("SELECT count(*) AS jul FROM surat_keterangan WHERE id_jenis_keterangan='$row[id_jenis_keterangan]'
            AND MONTH(tanggal_surat) = '07'");
            $jul->execute();
            $jull = $jul->fetch();

            $aug = $conn->prepare("SELECT count(*) AS aug FROM surat_keterangan WHERE id_jenis_keterangan='$row[id_jenis_keterangan]'
            AND MONTH(tanggal_surat) = '08'");
            $aug->execute();
            $augg = $aug->fetch();
        
            $sep = $conn->prepare("SELECT count(*) AS sep FROM surat_keterangan WHERE id_jenis_keterangan='$row[id_jenis_keterangan]'
            AND MONTH(tanggal_surat) = '09'");
            $sep->execute();
            $sepp = $sep->fetch();

            $oct = $conn->prepare("SELECT count(*) AS oct FROM surat_keterangan WHERE id_jenis_keterangan='$row[id_jenis_keterangan]'
            AND MONTH(tanggal_surat) = '10'");
            $oct->execute();
            $octt = $oct->fetch();

            $nov = $conn->prepare("SELECT count(*) AS nov FROM surat_keterangan WHERE id_jenis_keterangan='$row[id_jenis_keterangan]'
            AND MONTH(tanggal_surat) = '11'");
            $nov->execute();
            $novv = $nov->fetch();

            $dec = $conn->prepare("SELECT count(*) AS december FROM surat_keterangan WHERE id_jenis_keterangan='$row[id_jenis_keterangan]'
            AND MONTH(tanggal_surat) = '12'");
            $dec->execute();
            $decc = $dec->fetch();
        

        $total =$jann['jan']+$febb['feb']+$marr['mar']+$aprr['apr']+$mayy['may']+$junn['jun']+$jull['jul']+$augg['aug']+$sepp['sep']+$octt['oct']+$novv['nov']+$decc['december'];

    ?>
                                        <tr>
                                            <td><?php echo $no++; ?></td>
                                            <td><?php echo $row['jenis_keterangan'] ?></td>
                                            <td><b><?php echo $jann['jan'] ?></b></td>
                                            <td><b><?php echo $febb['feb'] ?></b></td>
                                            <td><b><?php echo $marr['mar'] ?></b></td>
                                            <td><b><?php echo $aprr['apr'] ?></b></td>
                                            <td><b><?php echo $mayy['may'] ?></b></td>
                                            <td><b><?php echo $junn['jun'] ?></b></td>
                                            <td><b><?php echo $jull['jul'] ?></b></td>
                                            <td><b><?php echo $augg['aug'] ?></b></td>
                                            <td><b><?php echo $sepp['sep'] ?></b></td>
                                            <td><b><?php echo $octt['oct'] ?></b></td>
                                            <td><b><?php echo $novv['nov'] ?></b></td>
                                            <td><b><?php echo $decc['december'] ?></b></td>
                                            <td><b><?php echo $total ?></b></td>
                                        </tr>
    <?php
        }
        $ttl = $conn->prepare("SELECT count(*) AS total FROM surat_keterangan");
        $ttl->execute();
        $totall = $ttl->fetch();
    ?>
                                        <tr>
                                            <td colspan="14"></td>
                                            <td><b><?php echo $totall['total'] ?></b></td>
                                        </tr>
                                    </tbody>
                                </table>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
        </main>
    </div>

    <script>
        let btn = document.querySelector("#btn");
        let sidebar = document.querySelector(".sidebar");

        btn.onclick = function(){
            sidebar.classList.toggle("active");
            document.querySelector(".drop").classList.remove("show");
            document.querySelector(".dropp").classList.remove("show");
        }

        function drop() {
            document.querySelector(".drop").classList.toggle("show");
            sidebar.classList.add("active");
        }
        function dropp() {
            document.querySelector(".dropp").classList.toggle("show");
            sidebar.classList.add("active");
        }
    </script>
</body>
</html>