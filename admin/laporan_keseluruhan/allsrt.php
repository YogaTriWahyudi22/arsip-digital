<?php
include '../../koneksi.php';
session_start();

// Pengambilan Data dari Database MySQL
$use = $conn->prepare("SELECT * FROM admin WHERE username='$_SESSION[username]'");
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
    <link rel="stylesheet" href="style/allsrt.css">
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <title>Laporan Keseluruhan Surat - Arsip Digital (Admin)</title>
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
            <li>
                <a href='../akun'>
                    <i class='bx bx-user'></i>
                    <span class=links_name>Kelola Akun</span>
                </a>
                <span class=tooltip>Kelola Akun</span>
            </li>
            <li>
                <a href='../jenis'>
                    <i class='bx bx-list-ol'></i>
                    <span class=links_name>Jenis Keterangan</span>
                </a>
                <span class=tooltip>Jenis Keterangan</span>
            </li>
            <li>
                <a href='../kelola_arsip'>
                    <i class='bx bxs-file-plus'></i>
                    <span class=links_name>Kelola Arsip Digital</span>
                </a>
                <span class=tooltip>Kelola Arsip Digital</span>
            </li>
            <li class="active" onclick="drop()">
                <label>
                    <i class='bx bx-file-find'></i>
                    <span class=links_name>Laporan Keseluruhan<i class='bx bx-caret-down'></i></span>
                </label>
                <span class=tooltip>Laporan Keseluruhan</span>
            </li>
            <div class="drop">
            <li class="active">
                <a href='../laporan_keseluruhan/allsrt.php'>
                    <i class='bx bx-dots-vertical-rounded'></i>
                    <span class=links_name>Seluruh Surat</span>
                </a>
            </li>
            <li>
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
                Laporan Keseluruhan Surat
            </h2>
            <div class="user">
                <img src="../../img/pp.jpg" width="40px" height="40px" alt="">
                <div>
                    <h4>
                    <?php
                        echo"$user[nama_lengkap]";
                    ?>
                    </h4>
                    <small>Admin</small>
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
                                    Data Keseluruhan Surat Tahun <?php echo date("Y") ?>
                                </h3>
                                <a href="allsrt-print.php">
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
                                            <td rowspan="2">Jenis Surat</td>
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
        // Penghitungan Data dari Database MySQL
        //Surat Masuk
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
                                            <td><?php echo $no++; ?></td>
                                            <td>Surat Masuk</td>
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
                                            <td><b><?php echo $total1 ?></b></td>
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
                                            <td><?php echo $no++; ?></td>
                                            <td>Surat Keluar</td>
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
                                            <td><b><?php echo $total2 ?></b></td>
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
                                            <td><?php echo $no++; ?></td>
                                            <td>Surat Keterangan</td>
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
                                            <td><b><?php echo $total3 ?></b></td>
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
                                            <td><?php echo $no++; ?></td>
                                            <td>Surat Keputusan</td>
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
                                            <td><b><?php echo $total4 ?></b></td>
                                        </tr>
    <?php
        $totall = $total1+$total2+$total3+$total4;
    ?>
                                        <tr>
                                            <td colspan="14"></td>
                                            <td><b><?php echo $totall ?></b></td>
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