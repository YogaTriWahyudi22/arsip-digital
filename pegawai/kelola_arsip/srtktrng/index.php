<?php
include '../../../koneksi.php';
session_start();

// Pengambilan Data dari Database MySQL
$use = $conn->prepare("SELECT * FROM pegawai WHERE username='$_SESSION[username]'");
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
    <link rel="stylesheet" href="style/index.css">
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <title>Surat Masuk - Arsip Digital (Pegawai)</title>
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
                <a href="../../index.php">
                <i class='bx bxs-dashboard'></i>
                    <span class="links_name">Dashboard</span>
                </a>
                <span class="tooltip">Dashboard</span>
            </li>
            <li class="active">
                <a href='../../kelola_arsip'>
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
                <a href='../../laporan_keseluruhan/allsrt.php'>
                    <i class='bx bx-dots-vertical-rounded'></i>
                    <span class=links_name>Seluruh Surat</span>
                </a>
            </li>
            <li>
                <a href='../../laporan_keseluruhan/srtktrng.php'>
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
                <a href='../../laporan/srtmasuk.php'>
                    <i class='bx bx-dots-vertical-rounded'></i>
                    <span class=links_name>Surat Masuk</span>
                </a>
            </li>
            <li>
                <a href='../../laporan/srtkeluar.php'>
                    <i class='bx bx-dots-vertical-rounded'></i>
                    <span class=links_name>Surat Keluar</span>
                </a>
            </li>
            <li>
                <a href='../../laporan/srtktrng.php'>
                    <i class='bx bx-dots-vertical-rounded'></i>
                    <span class=links_name>Surat Keterangan</span>
                </a>
            </li>
            <li>
                <a href='../../laporan/srtkptsn.php'>
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
                Surat Keterangan
            </h2>
            <div class="user">
                <img src="../../../img/pp.jpg" width="40px" height="40px" alt="">
                <div>
                    <h4>
                    <?php
                        echo"$user[nama_lengkap]";
                    ?>
                    </h4>
                    <small>Pegawai</small>
                </div>
                <div class="logout">
                <a href="../../../logout.php"><i class='bx bx-log-out' id="logout"></i></a>
                </div>
            </div>
        </header>

        <main>
        <div class="list">
            <a href="../index.php"><button class='bton'>< Kembali</button></a>
        </div>

            <div class="cards">
                <?php
                // Pengambilan Data dari Database MySQL
                $sql = $conn->prepare("SELECT * FROM jenis_keterangan");
                $sql->execute();
                $data = $sql->fetchAll();
                               
                // Perulangan(Looping) Data dari Database MySQL
                foreach($data as $value) {
                    $a = array(1,5,9,13,17,21,25);
                    $b = array(2,6,10,14,18,22,26);
                    $c = array(3,7,11,15,19,23,27);
                    $d = array(4,8,12,16,20,24,28);
                ?>
                <a href="data.php?id=<?php echo $value['id_jenis_keterangan'] ?>">
                <div class="card-single <?php
                    if(in_array($value['id_jenis_keterangan'],$a)){
                        echo"a";
                    } else if(in_array($value['id_jenis_keterangan'],$b)){
                        echo"b";
                    } else if(in_array($value['id_jenis_keterangan'],$c)){
                        echo"c";
                    } else if(in_array($value['id_jenis_keterangan'],$d)){
                        echo"d";
                    }
                ?>">
                    <div>
                        <h2><?php echo $value['jenis_keterangan'] ?></h2>
                    </div>
                    <div>
                        <span class='bx bxs-file'></span>
                    </div>
                </div></a>
                <?php } ?>
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