<?php
include '../../../koneksi.php';
session_start();

// Pengambilan Data dari Database MySQL
$use = $conn->prepare("SELECT * FROM pegawai WHERE username='$_SESSION[username]'");
$use->execute();
$user = $use->fetch();

// Pengambilan Data dari Database MySQL
$sql = $conn->prepare("SELECT * FROM surat_masuk WHERE id_surat_masuk = '$_GET[id]'");
$sql->execute();
$data = $sql->fetch();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/tambah.css">
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <title>Edit Data Surat Masuk - Arsip Digital (Pegawai)</title>
</head>
<body>
    <div class="main-content">
        <header>
            <h2>
                Surat Masuk
            </h2>
            <div class="user">
                <img src="../../../img/pp.jpg" width="40px" height="40px" alt="">
                <div>
                    <h4>
                    <?php
                        echo $user['nama_lengkap']
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
            <div class="table">
                <div class="data">
                        <div class="card">
                            <div class="card-header">
                                <h3>
                                    Edit Data Surat Masuk
                                </h3>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                <form method="post" action="edit-data.php?id=<?php echo $_GET['id']  ?>" enctype="multipart/form-data">
                                <table width="100%">
                                        <tr>
                                            <td>Asal Surat</td>
                                            <td><input type="text" name="asal_surat"
                                            value="<?php echo $data['asal_surat'] ?>"></td>
                                        </tr>
                                        <tr>
                                            <td>Tanggal Surat</td>
                                            <td><input type="date" name="tanggal_surat"
                                            value="<?php echo $data['tanggal_surat'] ?>"></td>
                                        </tr>
                                        <tr>
                                            <td>Nomor Surat</td>
                                            <td><input type="text" name="nomor_surat"
                                            value="<?php echo $data['nomor_surat'] ?>"></td>
                                        </tr>
                                        <tr>
                                            <td>Lampiran Surat</td>
                                            <td><input type="text" name="lampiran_surat"
                                            value="<?php echo $data['lampiran_surat'] ?>"></td>
                                        </tr>
                                        <tr>
                                            <td>Perihal</td>
                                            <td><input type="text" name="perihal"
                                            value="<?php echo $data['perihal'] ?>"></td>
                                        </tr>
                                        <tr>
                                            <td>Gambar Surat</td>
                                            <td><img src="../../../img/gambar_surat/<?php echo $data['gambar'] ?>"
                                            width="150px" height="200px">
                                            <input type="file" name="file" id="file">
                                            <span>(*Upload gambar jika ingin mengubah gambar surat)</span></td>
                                        </tr>
                                </table>
                                <div class="footer">
                                    <button type="submit" name="submit" class="btnn">Simpan & Kembali
                                    <span class='bx bxs-save'></span></button>
                                    <a href="index.php"><label name="back" class="btnnn">Kembali
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