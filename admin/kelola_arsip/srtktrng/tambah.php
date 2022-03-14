<?php
include '../../../koneksi.php';
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
    <title>Tambah Data <?php echo $sqli['jenis_keterangan'] ?> - Arsip Digital (Admin)</title>
</head>
<body>
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
                        echo $user['nama_lengkap']
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
            <div class="table">
                <div class="data">
                        <div class="card">
                            <div class="card-header">
                                <h3>
                                    Tambahkan Data [<?php echo $sqli['jenis_keterangan'] ?>]
                                </h3>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                <form method="post" action="tambah-surat.php?id=<?php echo $sqli['id_jenis_keterangan']?>" enctype="multipart/form-data">
                                <table width="100%">
                                        <tr>
                                            <td>Nomor Surat</td>
                                            <td><input type="text" name="nomor_surat"></td>
                                        </tr>
                                        <tr>
                                            <td>Pemohon</td>
                                            <td><input type="text" name="pemohon"></td>
                                        </tr>
                                        <tr>
                                            <td>Keperluan</td>
                                            <td><input type="text" name="keperluan"></td>
                                        </tr>
                                        <tr>
                                            <td>Tanggal Surat</td>
                                            <td><input type="date" name="tanggal_surat"></td>
                                        </tr>
                                        <tr>
                                            <td>Kepala Keluarga</td>
                                            <td><input type="text" name="kepala_keluarga"
                                            placeholder="(Boleh dikosongkan jika tidak ada isi)"></td>
                                        </tr>
                                        <tr>
                                            <td>Tanggungan</td>
                                            <td><input type="text" name="tanggungan"
                                            placeholder="(Boleh dikosongkan jika tidak ada isi)"></td>
                                        </tr>
                                        <tr>
                                            <td>Yang Meninggal</td>
                                            <td><input type="text" name="yg_meninggal"
                                            placeholder="(Boleh dikosongkan jika tidak ada isi)"></td>
                                        </tr>
                                        <tr>
                                            <td>Keterangan Meninggal</td>
                                            <td><input type="text" name="keterangan_meninggal"
                                            placeholder="(Boleh dikosongkan jika tidak ada isi)"></td>
                                        </tr>
                                        <tr>
                                            <td>Ahli Waris</td>
                                            <td><input type="text" name="ahli_waris"
                                            placeholder="(Boleh dikosongkan jika tidak ada isi)"></td>
                                        </tr>
                                        <tr>
                                            <td>Yang Bertanda Tangan</td>
                                            <td>
                                                <select name="yg_bertandatgn">
                                                    <option disabled selected>-Pilih Jabatan-</option>
                                                    <?php
                                                        $jbt = $conn->prepare("SELECT * FROM jabatan
                                                        WHERE id_jabatan >= 2");
                                                        $jbt->execute();
                                                        foreach ($jbt->fetchAll() as $jabt){
                                                            $kk = $conn->prepare("SELECT * FROM kepala_kantor
                                                            WHERE id_jabatan = '$jabt[id_jabatan]'");
                                                            $kk->execute();
                                                            $kekk = $kk->fetch(); ?>
                                                            <option value="<?php echo $jabt['id_jabatan'] ?>">
                                                            <?php echo $jabt['nama_jabatan'];
                                                                if(empty($kekk['nama_lengkap'])){
                                                                    echo"";
                                                                } else {echo" (".$kekk['nama_lengkap'].")";}
                                                            ?>
                                                            </option>
                                                        <?php } ?>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Gambar Surat</td>
                                            <td><input type="file" name="file" id="file"></td>
                                        </tr>
                                </table>
                                <div class="footer">
                                    <button type="submit" name="submit" class="btnn">Simpan
                                    <span class='bx bxs-save'></span></button>
                                    <a href="data.php?id=<?php echo $_GET['id'] ?>"><label name="back" class="btnnn">Kembali
                                    <span class='bx bx-arrow-back'></span>
                                    </label></a>
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