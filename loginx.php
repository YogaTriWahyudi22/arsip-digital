<?php
include 'koneksi.php';
$user = $_POST['username'];
$pass = $_POST['password'];

// Deklarasi Query MySQL
$login = $conn->prepare("SELECT * FROM user WHERE username = '$user' AND password = '$pass'");
$login->execute();

if($login->rowCount()>0){
    // Mengambil Data dari Query MySQL
    $data = $login->fetch();
    $username = $data['username'];

    if($data['status']==1){

        // Deklarasi Query MySQL
        $select = $conn->prepare("SELECT * FROM admin WHERE username = '$username'");
        $select->execute();
        // Mengambil Data dari Query MySQL
        $selectn = $select->fetchAll();

        if(!empty($username)){
            session_start();
            $_SESSION['username'] = $username;
            $_SESSION['nama_lengkap'] = $selectn['nama_lengkap'];
            header("Location:admin");
        }

    } else if($data['status']==2){

        // Deklarasi Query MySQL
        $select = $conn->prepare("SELECT * FROM pegawai WHERE username = '$username'");
        $select->execute();
        // Mengambil Data dari Query MySQL
        $selectn = $select->fetchAll();

        if(!empty($username)){
            session_start();
            $_SESSION['username'] = $username;
            $_SESSION['nama_lengkap'] = $selectn['nama_lengkap'];
            header("Location:pegawai");
        }
    } else if($data['status']==3){

        // Deklarasi Query MySQL
        $select = $conn->prepare("SELECT * FROM kepala_kantor WHERE username = '$username'");
        $select->execute();
        // Mengambil Data dari Query MySQL
        $selectn = $select->fetchAll();
        
        if(!empty($username)){
            session_start();
            $_SESSION['username'] = $username;
            $_SESSION['nama_lengkap'] = $selectn['nama_lengkap'];
            header("Location:kepala kantor");
        }
    }
}  else {
    ?>
        <script type="text/javascript">
        {
            alert("Username dan Password Anda Salah");
            javascript:history.back();
        }
        </script>
    <?php
}
?>