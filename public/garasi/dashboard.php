<?php 
    include_once("../../config/koneksi.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Garasi</title>
</head>
<body>
    <form action="dashboard.php" method="get">
        <label>Cari: </label>
        <input type="text" name="cari">
        <input type="submit" name="Cari">
    </form>
    <?php 
        if (isset($_GET['cari'])) {
            $cari = $_GET['cari'];
        }
    ?>
    <table border="1">
        <h1>Data Garasi</h1>
        |<a href="tambah/tambah.php"> Tambah Garasi </a>|
        |<a href="cetak.php" target="_blank"> Cetak </a>|
        |<a href="../dashboard.php"> Home </a>|<br><br>
        <?php 
            if (isset($_GET['cari'])) {
                $cari = $_GET['cari'];
                $ambildata = mysqli_query($kon, "SELECT garasi.id_garasi, kendaraan.brand, kendaraan.tipe, kendaraan.tahun,  kendaraan.warna_motor, kendaraan.gambar_motor AS gambar_motor, garasi.stok 
                                                    FROM kendaraan
                                                    INNER JOIN garasi
                                                    ON kendaraan.id_motor = garasi.kendaraan_id_motor
                                                    WHERE garasi.id_garasi LIKE '%" . $cari . "%' OR kendaraan.brand LIKE '%" . $cari . "%' OR kendaraan.tipe LIKE '%" . $cari . "%' OR kendaraan.warna_motor LIKE '%" . $cari . "%' OR garasi.stok LIKE '%" . $cari . "%'");
            } else {
                $ambildata = mysqli_query($kon, "SELECT garasi.id_garasi, kendaraan.brand, kendaraan.tipe, kendaraan.tahun,  kendaraan.warna_motor, kendaraan.gambar_motor AS gambar_motor, garasi.stok
                                                    FROM kendaraan
                                                    INNER JOIN garasi
                                                    ON kendaraan.id_motor = garasi.kendaraan_id_motor
                                                    ORDER BY garasi.id_garasi ASC");
                $num = mysqli_num_rows($ambildata);                          
            }
        ?>
        <tr>
            <th>ID Garasi</th>
            <th>Brand</th>
            <th>Tipe</th>
            <th>Tahun</th>
            <th>Warna</th>
            <th>Stok Motor</th>
            <th>Gambar Motor</th>
            <th>Aksi</th>
        </tr>
        <?php 
            if ($ambildata) {
                while ($userAmbilData = mysqli_fetch_array($ambildata)) {
                    echo "<tr>";
                        echo "<td>" . $id = $userAmbilData['id_garasi'] . "</td>";
                        echo "<td>" . $brand = $userAmbilData['brand'] . "</td>";
                        echo "<td>" . $tipe = $userAmbilData['tipe'] . "</td>";
                        echo "<td>" . $tahun = $userAmbilData['tahun'] . "</td>";
                        echo "<td>" . $warna = $userAmbilData['warna_motor'] . "</td>";
                        echo "<td>" . $warna = $userAmbilData['stok'] . "</td>";
                        echo "<td><img src='../kendaraan/aset/" . $userAmbilData['gambar_motor'] . "' alt='Gambar Motor' width='180' height='150'></td>";
                        echo "<td>
                                |<a href='view/view.php?id=" . $id . "'>View</a>|
                                |<a href='kendaraanhapus.php?id=" . $id . "'>Hapus</a>|
                            </td>";
                    echo "</tr>";
                }
            } else {
                "<tr><td colspan='6'>Data tidak ditemukan.</td></tr>";
            }
        ?>
    </table>
</body>
</html>