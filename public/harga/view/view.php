<?php 
    include_once("../../../config/koneksi.php");
    include_once("viewdata.php");

    $hargaController = new HargaController($kon);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vide Data Kendaraan</title>
</head>
<body>
    <a href="../dashboard.php">| Home |</a>
    <br><br>
    <form action="view.php" name="update_data" method="post">
        <table>
            <tr>
                <td>ID Harga</td>
                <td>: </td>
                <td><?php echo $id; ?></td>
            </tr>
            <tr>
                <td>Motor</td>
                <td>: </td>
                <td><?php echo $brand . ' ' . $tipe . ' ' . $tahun; ?></td>
            </tr>
            <tr>
                <td>Warna</td>
                <td>: </td>
                <td><?php echo $warna; ?></td>
            </tr>
            <tr>
                <td>Harga per Hari</td>
                <td>: </td>
                <td><?php echo $harga_per_hari; ?></td>
            </tr>
            <tr>
                <td>Gambar Motor</td>
                <td>: </td>
                <td><img src="../../kendaraan/aset/<?php echo $gambar_motor; ?>" alt="<?php echo $gambar_motor; ?>"></td>
            </tr>
        </table>
    </form>
</body>
</html>