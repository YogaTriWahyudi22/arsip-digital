<?php
include '../../koneksi.php';
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
    <link rel="stylesheet" href="style/srtkeluar.css">
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <title>Laporan Surat Keluar - Arsip Digital (Pegawai)</title>
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
                <a href='../kelola_arsip'>
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
            <li class="active" onclick="dropp()" class="a">
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
            <li class="active">
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
                Laporan Surat Keluar
            </h2>
            <div class="user">
                <img src="../../img/pp.jpg" width="40px" height="40px" alt="">
                <div>
                    <h4>
                    <?php
                        echo"$user[nama_lengkap]";
                    ?>
                    </h4>
                    <small>Pegawai</small>
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
                                    Data Surat Keluar
                                </h3>
                                <button onclick="submit()"  name="submit" class="btnnn">Print
                                <span class='bx bxs-printer'></span></button>
                            </div>
                            <div class="card-category">
                                <select id="tahun" onchange="tahun();">
                                    <option disabled selected>-Pilih Tahun-</option>
                                    <option value="2021">2021</option>
                                    <option value="2022">2022</option>
                                </select>
                                <select id="bulan" onchange="bulan(this.value);">
                                    <option disabled selected>-Pilih Bulan-</option>
                                </select>
                            </div>
    <script type="text/javascript">
        function tahun() {
            var thn = document.getElementById("tahun").value;
            var bln = document.getElementById("bulan");
            if(thn!=""){
                bln.innerHTML=`
                <option disabled selected>-Pilih Bulan-</option>
                <option value=1>Januari</option>
                <option value=2>Februari</option>
                <option value=3>Maret</option>
                <option value=4>April</option>
                <option value=5>Mei</option>
                <option value=6>Juni</option>
                <option value=7>Juli</option>
                <option value=8>Agustus</option>
                <option value=9>September</option>
                <option value=10>Oktober</option>
                <option value=11>November</option>
                <option value=12>Desember</option>
                `
                document.getElementsById("tahn").innerHTML="thn";
            }
        }

        function bulan(str) {
            if (str == "") {
                document.getElementById("table").innerHTML = "";
            return;
            } else {
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        document.getElementById("table").innerHTML = this.responseText;
                    }
            };
            var thn = document.getElementById("tahun");
            xmlhttp.open("GET","getsrtkeluar.php?thn="+thn.value+"&bln="+str,true);
            xmlhttp.send();
            }
        }

        function submit(){
            var bln = document.getElementById("bulan");
            var thn = document.getElementById("tahun");
            if(bln.selectedIndex == "") {
                alert("Pilih Tahun dan Bulan Terlebih Dahulu!")
            } else {
            window.location.href = 'srtkeluar-print.php?bulan='+bln.value+'&tahun='+thn.value;
            }
        }
    </script>
                            <div class="card-body">
                                <div class="table-responsive">
                                <div id="table">
                                <table width="100%">
                                    <thead>
                                        <tr>
                                            <td width="20px">No.</td>
                                            <td width="150px">Tanggal Surat</td>
                                            <td>Tujuan Surat</td>   
                                            <td>Perihal</td>
                                            <td>Gambar</td>
                                        </tr>
                                    </thead>
                                </table>
                                </div>
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