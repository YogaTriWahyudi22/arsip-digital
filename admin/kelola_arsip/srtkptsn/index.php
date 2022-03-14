<?php
include '../../../koneksi.php';
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
    <link rel="stylesheet" href="style/index.css">
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <title>Surat Keputusan - Arsip Digital (Admin)</title>
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
            <li>
                <a href='../../akun'>
                    <i class='bx bx-user'></i>
                    <span class=links_name>Kelola Akun</span>
                </a>
                <span class=tooltip>Kelola Akun</span>
            </li>
            <li>
                <a href='../../jenis'>
                    <i class='bx bx-list-ol'></i>
                    <span class=links_name>Jenis Keterangan</span>
                </a>
                <span class=tooltip>Jenis Keterangan</span>
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
            <li onclick="dropp()">
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
                Surat Keputusan
            </h2>
            <div class="user">
                <img src="../../../img/pp.jpg" width="40px" height="40px" alt="">
                <div>
                    <h4>
                    <?php
                        echo"$user[nama_lengkap]";
                    ?>
                    </h4>
                    <small>Admin</small>
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

            <div class="table">
                <div class="data">
                        <div class="card">
                            <div class="card-header">
                                <h3>
                                    Data Surat Keputusan
                                </h3>
                                <a href="tambah.php"><label name="back" class="btnnn">Tambah Data
                                <span class='bx bxs-file-plus'></span></a>
                            </div>
                            
                            <div class="card-body">
                                <div class="table-responsive">
                                <table width="100%">
                                    <form action="" method="post">
                                    <thead>
                                        <tr>
                                            <td width="20px">No.</td>
                                            <td width="150px">Tanggal Surat</td>
                                            <td width="250px">Nomor Surat</td>
                                            <td>Tentang</td>
                                            <td width="150px"></td>
                                        </tr>
                                    </thead></form>
                                    <tbody>
    <?php
        $no = 1;
        // Pengambilan Data dari Database MySQL
        $sql = $conn->prepare("SELECT * FROM surat_keputusan");
        $sql->execute();
        $data = $sql->fetchAll();

        // Perulangan(Looping) Data dari Database MySQL
        foreach ($data as $value){
    ?>
                                        <tr>
                                            <td><?php echo $no; ?></td>
                                            <td><?php echo $value['tanggal_surat']; ?></td>
                                            <td><?php echo $value['nomor_surat_keputusan']; ?></td>
                                            <td><?php echo $value['tentang']; ?></td>
                                            <td>
                                                <a href="edit.php?id=<?php echo $value['id_surat_keputusan'] ?>">
                                                <button class="btnlht" title="Edit"><i class='bx bxs-edit'></i></button></a>
                                                <a href="hapus.php?id=<?php echo $value['id_surat_keputusan'] ?>"
                                                onclick="return confirm('Anda yakin ingin menghapus data ini?')">
                                                <button class="btnlht" title="Hapus"><i class='bx bxs-trash'></i></button></a>
                                            </td>
                                        </tr>
    <?php $no++; } ?>
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