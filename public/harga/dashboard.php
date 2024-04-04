<?php 
    include_once("../../config/koneksi.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List Harga</title>
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
        <h1>List Harga Penyewaan</h1>
        |<a href="tambah/tambah.php"> Tambah Data </a>|
        |<a href="cetak.php" target="_blank"> Cetak </a>|
        |<a href="../dashboard.php"> Home </a>|
        <?php 
            if (isset($_GET['cari'])) {
                $cari = $_GET['cari'];
                $ambildata = mysqli_query($kon, "SELECT harga.id_harga, kendaraan.brand, kendaraan.tipe, kendaraan.tahun,  kendaraan.warna_motor, kendaraan.gambar_motor AS gambar_motor, harga.harga_per_hari
                                                    FROM kendaraan
                                                    INNER JOIN harga
                                                    ON kendaraan.id_motor = harga.kendaraan_id_motor
                                                    WHERE harga.id_harga LIKE '%" . $cari . "%' OR kendaraan.brand LIKE '%" . $cari . "%' OR kendaraan.tipe LIKE '%" . $cari . "%' OR kendaraan.warna_motor LIKE '%" . $cari . "%' OR harga.harga_per_hari LIKE '%" . $cari . "%'");
            } else {
                $ambildata = mysqli_query($kon, "SELECT harga.id_harga, kendaraan.brand, kendaraan.tipe, kendaraan.tahun,  kendaraan.warna_motor, kendaraan.gambar_motor AS gambar_motor, harga.harga_per_hari
                                                    FROM kendaraan
                                                    INNER JOIN harga
                                                    ON kendaraan.id_motor = harga.kendaraan_id_motor
                                                    ORDER BY harga.id_harga ASC");
                $num = mysqli_num_rows($ambildata);
            }
        ?>
        <tr>
            <th>ID Harga</th>
            <th>Motor</th>
            <th>Warna</th>
            <th>Gambar Motor</th>
            <th>Harga per Hari</th>
            <th>Aksi</th>
        </tr>
        <?php 
            if ($ambildata) {
                while ($userAmbilData = mysqli_fetch_array($ambildata)) {
                    echo "<tr>";
                        echo "<td>" . $id = $userAmbilData['id_harga'] . "</td>";
                        echo "<td>" . $userAmbilData['brand'] . ' ' . $userAmbilData['tipe'] . ' ' . $userAmbilData['tahun'] . ' ' . "</td>";
                        echo "<td>" . $warna_motor = $userAmbilData['warna_motor'] . "</td>";
                        echo "<td><img src='../kendaraan/aset/" . $userAmbilData['gambar_motor'] . "' alt='Gambar Motor' width='180' height='150'></td>"; 
                        echo "<td>Rp. " . $harga_per_hari = $userAmbilData['harga_per_hari'] . "</td>";
                        echo "<td>
                                |<a href='update/update.php?id=" . $userAmbilData['id_harga'] . "'>Update</a>|
                                |<a href='view/view.php?id=" . $userAmbilData['id_harga'] . "'>View</a>|
                                |<a href='hargahapus.php?id=" . $userAmbilData['id_harga'] . "'>Hapus</a>|
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