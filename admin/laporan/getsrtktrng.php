<?php
include '../../koneksi.php';

$bln = intval($_GET['bln']);
$jns = intval($_GET['jenis']);
$thn = intval($_GET['thn']);

// Pengambilan Data dari Database MySQL
$sql = $conn->prepare("SELECT * FROM surat_keterangan WHERE MONTH(tanggal_surat)='$bln' AND id_jenis_keterangan = '$jns'
AND YEAR(tanggal_surat)='$thn'");
$sql->execute();
$select = $sql->fetchAll();

// Pengambilan Data dari Database MySQL
$sqll = $conn->prepare("SELECT * FROM jenis_keterangan WHERE id_jenis_keterangan = '$jns'");
$sqll->execute();
$sqli = $sqll->fetch();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        .img embed {
            width: 200px;
            height: 250px;
        }
    </style>
</head>
<body>
    <table width="100%">
        <thead>
            <tr>
                <td width="20px">No.</td>
                <td>Jenis Surat</td>
                <td width="150px">Tanggal Surat</td>
                <td>Pemohon</td>
                <td>Gambar</td>
            </tr>
        </thead>
        <tbody>
        <?php
            $no=1;
            // Perulangan(Looping) Data dari Database MySQL
            foreach($select as $value){ ?>
            <tr>
                <td><?php echo $no++; ?></td>
                <td><?php echo $sqli['jenis_keterangan'] ?></td>
                <td><?php echo $value['tanggal_surat'] ?></td>
                <td><?php echo $value['pemohon'] ?></td>
                <td class="img">
                    <?php
                        if(empty($value['gambar'])){
                            echo"Tidak Ada Gambar";
                        } else {
                    ?>
                    <a href="download.php?gambar=<?php echo $value['gambar'] ?>">
                    <embed src="../../img/gambar_surat/<?php echo $value['gambar'] ?>" title="Klik utk download">
                    </a>
                    <?php } ?>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</body>
</html>