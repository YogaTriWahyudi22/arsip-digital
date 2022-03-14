<?php
include '../koneksi.php';
session_start();

// Pengambilan Data dari Database MySQL
$use = $conn->prepare("SELECT * FROM admin WHERE username='$_SESSION[username]'");
$use->execute();
$user = $use->fetch();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/index.css">
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <title>Dashboard - Arsip Digital (Admin)</title>
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
            <li class="active">
                <a href="index.php">
                <i class='bx bxs-dashboard'></i>
                    <span class="links_name">Dashboard</span>
                </a>
                <span class="tooltip">Dashboard</span>
            </li>
            <li>
                <a href='akun'>
                    <i class='bx bx-user'></i>
                    <span class=links_name>Kelola Akun</span>
                </a>
                <span class=tooltip>Kelola Akun</span>
            </li>
            <li>
                <a href='jenis'>
                    <i class='bx bx-list-ol'></i>
                    <span class=links_name>Jenis Keterangan</span>
                </a>
                <span class=tooltip>Jenis Keterangan</span>
            </li>
            <li>
                <a href='kelola_arsip'>
                    <i class='bx bxs-file-plus'></i>
                    <span class=links_name>Kelola Arsip Digital</span>
                </a>
                <span class=tooltip>Kelola Arsip Digital</span>
            </li>
            <li onclick="drop()">
                <label>
                    <i class='bx bx-file-find'></i>
                    <span class=links_name>Laporan Keseluruhan<i class='bx bx-caret-down'></i></span>
                </label>
                <span class=tooltip>Laporan Keseluruhan</span>
            </li>
            <div class="drop">
            <li>
                <a href='laporan_keseluruhan/allsrt.php'>
                    <i class='bx bx-dots-vertical-rounded'></i>
                    <span class=links_name>Seluruh Surat</span>
                </a>
            </li>
            <li>
                <a href='laporan_keseluruhan/srtktrng.php'>
                    <i class='bx bx-dots-vertical-rounded'></i>
                    <span class=links_name>Surat Keterangan</span>
                </a>
            </li>
            </div>
            <li onclick="dropp()">
                <label>
                    <i class='bx bx-file'></i>
                    <span class=links_name>Laporan Surat<i class='bx bx-caret-down'></i></span>
                </label>
                <span class=tooltip>Laporan Surat</span>
            </li>
            <div class="dropp">
            <li>
                <a href='laporan/srtmasuk.php'>
                    <i class='bx bx-dots-vertical-rounded'></i>
                    <span class=links_name>Surat Masuk</span>
                </a>
            </li>
            <li>
                <a href='laporan/srtkeluar.php'>
                    <i class='bx bx-dots-vertical-rounded'></i>
                    <span class=links_name>Surat Keluar</span>
                </a>
            </li>
            <li>
                <a href='laporan/srtktrng.php'>
                    <i class='bx bx-dots-vertical-rounded'></i>
                    <span class=links_name>Surat Keterangan</span>
                </a>
            </li>
            <li>
                <a href='laporan/srtkptsn.php'>
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
                Dashboard
            </h2>
            <div class="user">
                <img src="../img/pp.jpg" width="40px" height="40px" alt="">
                <div>
                    <h4>
                    <?php
                        echo"$user[nama_lengkap]";
                    ?>
                    </h4>
                    <small>Admin</small>
                </div>
                <div class="logout">
                <a href="../logout.php"><i class='bx bx-log-out' id="logout"></i></a>
                </div>
            </div>
        </header>

        <main>
            <div class="greeting">
                <p>
                <?php
                    date_default_timezone_set('Asia/Jakarta');
                    $Hour = date('G');
                    
                    if ( $Hour >= 5 && $Hour <= 11 ) {
                        echo "<i class='bx bx-sun bx-tada' ></i> Selamat Pagi";
                    } else if ( $Hour >= 12 && $Hour <= 18 ) {
                        echo "<i class='bx bxs-sun bx-tada' ></i> Selamat Siang";
                    } else if ( $Hour >= 19 || $Hour < 5 ) {
                        echo "<i class='bx bxs-moon bx-tada' ></i> Selamat Malam";
                    } echo", $user[nama_lengkap]";
                ?> </p>
            </div>

            <div class="cards">
                <div class="card-single">
                    <div>
                        <h6>Surat Masuk</h6>
                        <p>Jumlah Total Surat</p>
                        <?php
                        // Penghitungan Data dari Database MySQL
                        $msk = $conn->prepare("SELECT count(*) as jml FROM surat_masuk");
                        $msk->execute();
                        $jmsk = $msk->fetch();
                        ?>
                        <h1><?php echo $jmsk['jml'] ?></h1>
                    </div>
                </div>
                <div class="card-single">
                    <div>
                        <h6>Surat Keluar</h6>
                        <p>Jumlah Total Surat</p>
                        <?php
                        // Penghitungan Data dari Database MySQL
                        $klr = $conn->prepare("SELECT count(*) as jml FROM surat_keluar");
                        $klr->execute();
                        $jklr = $klr->fetch();
                        ?>
                        <h1><?php echo $jklr['jml'] ?></h1>
                    </div>
                </div>
                <div class="card-single">
                    <div>
                        <h6>Surat Keterangan</h6>
                        <p>Jumlah Total Surat</p>
                        <?php
                        // Penghitungan Data dari Database MySQL
                        $ktr = $conn->prepare("SELECT count(*) as jml FROM surat_keterangan");
                        $ktr->execute();
                        $jktr = $ktr->fetch();
                        ?>
                        <h1><?php echo $jktr['jml'] ?></h1>
                    </div>
                </div>
                <div class="card-single">
                    <div>
                        <h6>Surat Keputusan</h6>
                        <p>Jumlah Total Surat</p>
                        <?php
                        // Penghitungan Data dari Database MySQL
                        $kpt = $conn->prepare("SELECT count(*) as jml FROM surat_keputusan");
                        $kpt->execute();
                        $jkpt = $kpt->fetch();
                        ?>
                        <h1><?php echo $jkpt['jml'] ?></h1>
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