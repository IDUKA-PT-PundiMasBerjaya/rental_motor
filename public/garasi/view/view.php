<?php 
    include_once("../../../config/koneksi.php");
    include_once("viewdata.php");

    $garasiController = new KendaraanController($kon);
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
                <td>ID Garasi</td>
                <td>: </td>
                <td><?php echo $id; ?></td>
            </tr>
            <tr>
                <td>Brand</td>
                <td>: </td>
                <td><?php echo $brand; ?></td>
            </tr>
            <tr>
                <td>Tipe</td>
                <td>: </td>
                <td><?php echo $tipe; ?></td>
            </tr>
            <tr>
                <td>Tahun</td>
                <td>: </td>
                <td><?php echo $tahun; ?></td>
            </tr>
            <tr>
                <td>Warna</td>
                <td>: </td>
                <td><?php echo $warna_motor; ?></td>
            </tr>
            <tr>
                <td>Ketersediaan</td>
                <td>: </td>
                <td><?php echo $stok; ?></td>
            </tr>
            <tr>
                <td>Gambar Motor</td>
                <td>: </td>
                <td><img src="../../kendaraan/aset/<?php echo $gambar_motor; ?>" alt="<?php echo $gambar_motor; ?>" width="180" height="150"></td>
            </tr>
        </table>
    </form>
</body>
</html>