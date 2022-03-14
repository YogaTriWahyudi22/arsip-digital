<?php
include '../../koneksi.php';
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
    <link rel="stylesheet" href="style/tambah.css">
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <title>Tambah Data Akun - Arsip Digital (Admin)</title>
</head>

<body>
    <div class="main-content">
        <header>
            <h2>
                Kelola Akun
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
                                Tambahkan Data Akun
                            </h3>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <form method="post" action="">
                                    <table width="100%">
                                        <tr>
                                            <td>Nama Lengkap</td>
                                            <td><input type="text" name="nama_lengkap"></td>
                                        </tr>
                                        <tr>
                                            <td>Username</td>
                                            <td><input type="text" name="username"></td>
                                        </tr>
                                        <tr>
                                            <td>Password</td>
                                            <td><input type="password" name="password"></td>
                                        </tr>
                                        <tr>
                                            <td>Status</td>
                                            <td>
                                                <select name="status">
                                                    <option selected disabled>-Pilih Status-</option>
                                                    <option value="1">Admin</option>
                                                    <option value="2">Pegawai</option>
                                                    <option value="3">Kepala Kantor</option>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Jabatan</td>
                                            <td>
                                                <select name="id_jabatan">
                                                    <?php
                                                    $sql_jbtn = $conn->prepare("SELECT * FROM jabatan");
                                                    $sql_jbtn->execute();
                                                    $jbtn = $sql_jbtn->fetchAll();
                                                    foreach ($jbtn as $jabtn) {
                                                        $kep = $conn->prepare("SELECT * FROM kepala_kantor
                                                        WHERE id_jabatan = '$jabtn[id_jabatan]'");
                                                        $kep->execute();
                                                        $kepp = $kep->fetch(); ?>
                                                        <option value="<?php echo $jabtn['id_jabatan'] ?>" <?php
                                                                                                            if (!empty($kepp['id_kepala_kantor'])) {
                                                                                                                echo "disabled";
                                                                                                            } else {
                                                                                                            }
                                                                                                            ?>>
                                                            <?php if ($jabtn['id_jabatan'] == 1) {
                                                                echo "-Pilih Jabatan- (Boleh dikosongkan jika tidak ada jabatan)";
                                                            } else {
                                                                echo $jabtn['nama_jabatan'];
                                                            } ?></option>
                                                    <?php } ?>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>NIP</td>
                                            <td><input type="text" name="nip"></td>
                                        </tr>
                                        <tr>
                                            <td>Nomor HP</td>
                                            <td><input type="number" name="nohp"></td>
                                        </tr>
                                        <tr>
                                            <td>Alamat</td>
                                            <td><input type="text" name="alamat"></td>
                                        </tr>
                                    </table>
                                    <div class="footer">
                                        <button type="submit" name="submit" class="btnn">Simpan
                                            <span class='bx bxs-save'></span></button>
                                        <a href="index.php"><label name="back" class="btnnn">Kembali
                                                <span class='bx bx-arrow-back'></span>
                                            </label></a>
                                        <?php
                                        if (isset($_POST['submit'])) {
                                            if (isset($_POST['status'])) {
                                                # code...

                                                if ($_POST['status'] == 1) {
                                                    // Menambahkan Data Database MySQL
                                                    $insert = $conn->prepare("INSERT INTO admin(nama_lengkap,username,nohp,alamat,id_jabatan,nip) VALUES
                ('" . $_POST['nama_lengkap'] . "','" . $_POST['username'] . "',
                '" . $_POST['nohp'] . "','" . $_POST['alamat'] . "','" . $_POST['id_jabatan'] . "','" . $_POST['nip'] . "')");
                                                    $insert->execute();

                                                    // Menambahkan Data Database MySQL
                                                    $insertt = $conn->prepare("INSERT INTO user(username,password,status,ket) VALUES
                ('" . $_POST['username'] . "','" . $_POST['password'] . "',
                '" . $_POST['status'] . "','admin')");
                                                    $insertt->execute();
                                                } else if ($_POST['status'] == 2) {
                                                    // Menambahkan Data Database MySQL
                                                    $insert = $conn->prepare("INSERT INTO pegawai(nama_lengkap,username,nohp,alamat,id_jabatan,nip) VALUES
                ('" . $_POST['nama_lengkap'] . "','" . $_POST['username'] . "',
                '" . $_POST['nohp'] . "','" . $_POST['alamat'] . "','" . $_POST['id_jabatan'] . "','" . $_POST['nip'] . "')");
                                                    $insert->execute();

                                                    // Menambahkan Data Database MySQL
                                                    $insertt = $conn->prepare("INSERT INTO user(username,password,status,ket) VALUES
                ('" . $_POST['username'] . "','" . $_POST['password'] . "',
                '" . $_POST['status'] . "','pegawai')");
                                                    $insertt->execute();
                                                } else if ($_POST['status'] == 3) {
                                                    // Menambahkan Data Database MySQL
                                                    $insert = $conn->prepare("INSERT INTO kepala_kantor(nama_lengkap,username,nohp,alamat,id_jabatan,nip) VALUES
                ('" . $_POST['nama_lengkap'] . "','" . $_POST['username'] . "',
                '" . $_POST['nohp'] . "','" . $_POST['alamat'] . "','" . $_POST['id_jabatan'] . "','" . $_POST['nip'] . "')");
                                                    $insert->execute();

                                                    // Menambahkan Data Database MySQL
                                                    $insertt = $conn->prepare("INSERT INTO user(username,password,status,ket) VALUES
                ('" . $_POST['username'] . "','" . $_POST['password'] . "',
                '" . $_POST['status'] . "','kepala kantor')");
                                                    $insertt->execute();
                                                }
                                            }
                                            if ($insert && $insertt) {
                                                echo "
                    <script type='text/javascript'>
                        alert('Data Berhasil Ditambah!')
                    </script>
                ";
                                            } else {
                                                echo "
                    <script type='javascript'>
                        alert('Data Gagal Ditambah!')
                    </script>
                ";
                                            }
                                        }
                                        ?>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
    </main>
    </div>
</body>

</html>