<?php
include '../../koneksi.php';
session_start();

// Pengambilan Data dari Database MySQL
$use = $conn->prepare("SELECT * FROM admin WHERE username='$_SESSION[username]'");
$use->execute();
$user = $use->fetch();

// Pengambilan Data dari Database MySQL
$sql = $conn->prepare("SELECT * FROM jenis_keterangan WHERE id_jenis_keterangan = '$_GET[id]'");
$sql->execute();
$sqli = $sql->fetch();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/tambah.css">
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <title>Edit Data Jenis Surat Keterangan - Arsip Digital (Admin)</title>
</head>
<body>
    <div class="main-content">
        <header>
            <h2>
                Jenis Surat Keterangan
            </h2>
            <div class="user">
                <img src="../../img/pp.jpg" width="40px" height="40px" alt="">
                <div>
                    <h4>
                    <?php
                        echo $user['nama_lengkap']
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
                                    Edit Data Jenis Surat Keterangan
                                </h3>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                <form method="post" action="">
                                <table width="100%">
                                        <tr>
                                            <td>Nama Jenis Surat Keterangan</td>
                                            <td><input type="text" name="jenis_keterangan" maxlength="50"
                                            value="<?php echo $sqli["jenis_keterangan"] ?>"></td>
                                        </tr>
                                </table>
                                <div class="footer">
                                    <button type="submit" name="submit" class="btnn">Simpan & Kembali
                                    <span class='bx bxs-save'></span></button>
                                    <a href="index.php"><label name="back" class="btnnn">Kembali
                                    <span class='bx bx-arrow-back'></span>
                                    </label></a>
    <?php
        if(isset($_POST['submit'])){
            // Mengubah Data Database MySQL
            $insert = $conn->prepare("UPDATE jenis_keterangan SET
            jenis_keterangan = '".$_POST['jenis_keterangan']."'
            WHERE id_jenis_keterangan = '".$_GET['id']."'");
            $insert->execute();

            if($insert){
                echo"
                    <script type='text/javascript'>
                        alert('Data Berhasil Diubah!')
                        window.location.href='index.php';
                    </script>
                ";
            } else {
                echo"
                    <script type='javascript'>
                        alert('Data Gagal Diubah!')
                    </script>
                ";
            }
        }
    ?>
                                </form></div>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
        </main>
    </div>
</body>
</html>