<?php 
    include_once("../../config/koneksi.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Kendaraan</title>
</head>
<body>
    <form action="dashboard.php" method="get">
        <label>Cari: </label>
        <input type="text" name="cari" value="<?php echo isset($_GET['cari']) ? $_GET['cari'] : ''; ?>">
        <input type="submit" value="Cari">
    </form>
    <?php 
        if (isset($_GET['cari'])) {
            $cari = $_GET['cari'];
        }
    ?>
    <table border="1">
        <h1>List Kendaraan</h1>
        |<a href="tambah/tambah.php"> Tambah Data </a>|
        |<a href="cetak.php" target="_blank"> Cetak </a>|
        |<a href="../dashboard.php"> Home </a>|
            <?php 
                if (isset($_GET['cari'])) {
                    $ambildata = mysqli_query($kon, "SELECT * FROM kendaraan
                                                        WHERE id_motor LIKE '%" . $cari . "%' OR brand LIKE '%" . $cari . "%' OR tahun LIKE '%" . $cari . "%'");
                } else {
                    $ambildata = mysqli_query($kon, "SELECT * FROM kendaraan
                                                        ORDER BY id_motor ASC");
                    $num = mysqli_num_rows($ambildata);
                }
            ?>
        <tr>
            <th> ID </th>
            <th> Brand </th>
            <th> Tipe </th>
            <th> Tahun </th>
            <th> Warna </th>
            <th> Harga </th>
            <th> Gambar Motor </th>
            <th> Aksi </th>
        </tr>
        <?php 
            if ($ambildata) {
                while ($userAmbilData = mysqli_fetch_array($ambildata)) {
                    echo "<tr>";
                        echo "<td>" . $id = $userAmbilData['id_motor'] . "</td>";
                        echo "<td>" . $brand = $userAmbilData['brand'] . "</td>";
                        echo "<td>" . $tipe = $userAmbilData['tipe'] . "</td>";
                        echo "<td>" . $tahun = $userAmbilData['tahun'] . "</td>";
                        echo "<td>" . $warna = $userAmbilData['warna_motor'] . "</td>";
                        echo "<td>Rp. " . $warna = $userAmbilData['harga_per_hari'] . "/Hari</td>";
                        echo "<td>";
                            $data = mysqli_query($kon, "SELECT * FROM kendaraan WHERE id_motor = '{$userAmbilData['id_motor']}'");
                            while ($row = mysqli_fetch_array($data)) {
                                echo "<a href='javascript:void(0);' onclick=\"window.open('aset/{$row['gambar_motor']}', '_blank');\">
                                        <img src='aset/{$row['gambar_motor']}' alt='Gambar Motor' width='180' height='150'></a>";
                            }
                        echo "</td>";
                        echo "<td>
                                |<a href='update/update.php?id=" . $userAmbilData['id_motor'] . "'>Update</a>|
                                |<a href='view/view.php?id=" . $userAmbilData['id_motor'] . "'>View</a>|
                                |<a href='motorhapus.php?id=" . $userAmbilData['id_motor'] . "'>Hapus</a>|
                            </td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='7'>Data tidak ditemukan.</td></tr>";
            }
        ?>
    </table>
</body>
</html>
