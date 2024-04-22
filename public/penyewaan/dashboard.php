<?php 
    include_once("../../config/koneksi.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Penyewaan</title>
</head>
<body>
    <form action="dashboard.php" method="get">
        <label>Cari :</label>
        <input type="text" name="cari">
        <input type="submit" name="Cari">
    </form>
    <?php 
        if (isset($_GET['cari'])) {
            $cari = $_GET['cari'];
        }
    ?>
    <table border="1">
        <h1>Data Penyewaan</h1>
        |<a href="tambah/tambah.php"> Tambah Data </a>|
        |<a href="cetak.php" target="_blank"> Cetak </a>|
        |<a href="../dashboard.php"> Home </a>|
            <?php 
                if (isset($_GET['cari'])) {
                    $cari = $_GET['cari'];
                    $sql = "SELECT penyewaan.id_penyewaan, customer.nama AS namapenyewa, penyewaan.tanggal_pinjam, penyewaan.tanggal_balik FROM penyewaan
                            LEFT JOIN customer ON penyewaan.penyewaan_id_customer = customer.id_customer
                            WHERE penyewaan.id_penyewaan LIKE '%$cari%' OR customer.nama LIKE '%$cari%' OR penyewaan.tanggal_pinjam LIKE '%$cari%' OR penyewaan.tanggal_balik LIKE '%$cari%'";
                } else {
                    $sql = "SELECT penyewaan.id_penyewaan, customer.nama AS namapenyewa, penyewaan.tanggal_pinjam, penyewaan.tanggal_balik FROM penyewaan
                            LEFT JOIN customer ON penyewaan.penyewaan_id_customer = customer.id_customer
                            ORDER BY penyewaan.id_penyewaan ASC";
                }

                $ambildata = mysqli_query($kon, $sql);
                if (!$ambildata) {
                    die("Query Error: " . mysqli_error($kon));
                }
                $num = mysqli_num_rows($ambildata);
            ?>
        <tr>
            <th> ID Penyewaan </th>
            <th> Nama Penyewa </th>
            <th> Tanggal Peminjaman </th>
            <th> Tanggal Pengembalian </th>
            <th> Aksi </th>
        </tr>
        <tr>
            <?php 
                while ($userAmbilData = mysqli_fetch_array($ambildata)) {
                    echo "<tr>";
                        echo "<td>" . $id = $userAmbilData['id_penyewaan'] . "</td>";
                        echo "<td>" . $namapenyewa = $userAmbilData['namapenyewa'] . "</td>";
                        echo "<td>" . $tanggalpinjam = $userAmbilData['tanggal_pinjam'] . "</td>";
                        echo "<td>" . $tanggalbalik = $userAmbilData['tanggal_balik'] . "</td>";
                        echo "<td>
                                | <a href='view/view.php?id=" . $id . "'>View</a> |
                            </td>";
                    echo "</tr>";
                }
            ?>
        </tr>
    </table>
</body>
</html>