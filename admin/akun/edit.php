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

// Pengambilan Data dari Database MySQL
$sql = $conn->prepare("SELECT * FROM user WHERE id_user = '$_GET[id]'");
$sql->execute();
$sqli = $sql->fetch();
if ($sqli['status'] == 1) {
    // Pengambilan Data dari Database MySQL
    $sqll = $conn->prepare("SELECT * FROM admin WHERE username='$sqli[username]'");
    $sqll->execute();
    $sqlli = $sqll->fetch();
} else if ($sqli['status'] == 2) {
    // Pengambilan Data dari Database MySQL
    $sqll = $conn->prepare("SELECT * FROM pegawai WHERE username='$sqli[username]'");
    $sqll->execute();
    $sqlli = $sqll->fetch();
} else if ($sqli['status'] == 3) {
    // Pengambilan Data dari Database MySQL
    $sqll = $conn->prepare("SELECT * FROM kepala_kantor WHERE username='$sqli[username]'");
    $sqll->execute();
    $sqlli = $sqll->fetch();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/tambah.css">
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <title>Edit Data Akun - Arsip Digital (Admin)</title>
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
                                Edit Data Akun
                            </h3>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <form method="post" action="">
                                    <table width="100%">
                                        <tr>
                                            <td>Nama Lengkap</td>
                                            <td><input type="text" name="nama_lengkap" value="<?php echo $sqlli['nama_lengkap'] ?>"></td>
                                        </tr>
                                        <tr>
                                            <td>Username</td>
                                            <td><input type="text" name="username" value="<?php echo $sqlli['username'] ?>"></td>
                                        </tr>
                                        <tr>
                                            <td>Password</td>
                                            <td><input type="text" name="password" value="<?php echo $sqli['password']; ?>"></td>
                                        </tr>
                                        <tr>
                                        <tr>
                                            <td>Status</td>
                                            <td>
                                                <select disabled>
                                                    <?php
                                                    if ($sqli['status'] == 1) { ?>
                                                        <option value="1" selected>Admin</option>
                                                        <option value="2">Pegawai</option>
                                                        <option value="3">Kepala Kantor</option>
                                                    <?php
                                                    } else if ($sqli['status'] == 2) { ?>
                                                        <option value="1">Admin</option>
                                                        <option value="2" selected>Pegawai</option>
                                                        <option value="3">Kepala Kantor</option>
                                                    <?php
                                                    } else if ($sqli['status'] == 3) { ?>
                                                        <option value="1">Admin</option>
                                                        <option value="2">Pegawai</option>
                                                        <option value="3" selected>Kepala Kantor</option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                            </td>
                                        </tr>
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
                                                                                                        if ($sqlli['id_jabatan'] == $jabtn['id_jabatan']) {
                                                                                                            echo "selected";
                                                                                                        } else {
                                                                                                        }
                                                                                                        ?> <?php
                                                        if (!empty($kepp['id_kepala_kantor'])) {
                                                            echo "disabled";
                                                        } else {
                                                        }
                                                        ?>>
                                                        <?php
                                                        if ($jabtn['id_jabatan'] == 0) {
                                                            echo "Jabatan Kosong";
                                                        } else {
                                                            echo $jabtn['nama_jabatan'];
                                                        } ?></option>
                                                <?php } ?>
                                            </select>
                                        </td>
                                        </tr>
                                        <tr>
                                            <td>NIP</td>
                                            <td><input type="text" name="nip" value="<?php echo $sqlli['nip']; ?>"></td>
                                        </tr>
                                        <tr>
                                            <td>Nomor HP</td>
                                            <td><input type="number" name="nohp" value="<?php echo $sqlli['nohp']; ?>"></td>
                                        </tr>
                                        <tr>
                                            <td>Alamat</td>
                                            <td><input type="text" name="alamat" value="<?php echo $sqlli['alamat'] ?>"></td>
                                        </tr>
                                    </table>
                                    <div class="footer">
                                        <button type="submit" name="submit" class="btnn"><?php
                                                                                            if ($_GET['id'] == $useer['id_user']) {
                                                                                                echo "Simpan & Logout";
                                                                                            } else {
                                                                                                echo "Simpan & Kembali";
                                                                                            }
                                                                                            ?>
                                            <span class='bx bxs-save'></span></button>
                                        <a href="index.php"><label name="back" class="btnnn">Kembali
                                                <span class='bx bx-arrow-back'></span>
                                            </label></a>
                                        <?php
                                        if (isset($_POST['submit'])) {
                                            if ($sqli['status'] == 1) {
                                                // Mengubah Data Database MySQL
                                                $insert = $conn->prepare("UPDATE admin SET
                nama_lengkap = '" . $_POST['nama_lengkap'] . "',
                username = '" . $_POST['username'] . "',
                id_jabatan = '" . $_POST['id_jabatan'] . "',
                nip = '" . $_POST['nip'] . "',
                nohp = '" . $_POST['nohp'] . "',
                alamat = '" . $_POST['alamat'] . "'
                WHERE id_admin = '" . $sqlli['id_admin'] . "'");
                                                $insert->execute();
                                            } else if ($sqli['status'] == 2) {
                                                // Mengubah Data Database MySQL
                                                $insert = $conn->prepare("UPDATE pegawai SET
                nama_lengkap = '" . $_POST['nama_lengkap'] . "',
                username = '" . $_POST['username'] . "',
                id_jabatan = '" . $_POST['id_jabatan'] . "',
                nip = '" . $_POST['nip'] . "',
                nohp = '" . $_POST['nohp'] . "',
                alamat = '" . $_POST['alamat'] . "'
                WHERE id_pegawai = '" . $sqlli['id_pegawai'] . "'");
                                                $insert->execute();
                                            } else if ($sqli['status'] == 3) {
                                                // Mengubah Data Database MySQL
                                                $insert = $conn->prepare("UPDATE kepala_kantor SET
                nama_lengkap = '" . $_POST['nama_lengkap'] . "',
                username = '" . $_POST['username'] . "',
                id_jabatan = '" . $_POST['id_jabatan'] . "',
                nip = '" . $_POST['nip'] . "',
                nohp = '" . $_POST['nohp'] . "',
                alamat = '" . $_POST['alamat'] . "'
                WHERE id_kepala_kantor = '" . $sqlli['id_kepala_kantor'] . "'");
                                                $insert->execute();
                                            }

                                            if (empty($_POST['password'])) {
                                                $insertt = $conn->prepare("UPDATE user SET
                    username = '" . $_POST['username'] . "'
                    WHERE id_user = '" . $_GET['id'] . "'");
                                                $insertt->execute();
                                            } else {
                                                $insertt = $conn->prepare("UPDATE user SET
                username = '" . $_POST['username'] . "',
                password = '" . $_POST['password'] . "'
                WHERE id_user = '" . $_GET['id'] . "'");
                                                $insertt->execute();
                                            }

                                            if ($insert && $insertt) {
                                                if ($_GET['id'] == $useer['id_user']) {
                                                    echo "
                    <script type='text/javascript'>
                        alert('Data Berhasil Diubah!')
                        window.location.href='../../logout.php';
                    </script>
                ";
                                                } else {
                                                    echo "
                    <script type='text/javascript'>
                        alert('Data Berhasil Diubah!')
                        window.location.href='index.php';
                    </script>
                ";
                                                }
                                            } else {
                                                echo "
                    <script type='javascript'>
                        alert('Data Gagal Diubah!')
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