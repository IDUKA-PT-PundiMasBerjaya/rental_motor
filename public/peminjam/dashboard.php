<?php 
    include_once("../../config/koneksi.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Peminjam</title>
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
        <h1>Data Peminjam</h1>
        |<a href="tambah/tambah.php"> Tambah Data </a>|
        |<a href="cetak.php" target="_blank"> Cetak </a>|
        |<a href="../dashboard.php"> Home </a>|
            <?php 
                if (isset($_GET['cari'])) {
                    $cari = $_GET['cari'];
                    $sql = "SELECT peminjam.id_peminjam, customer.nama AS namapeminjam, peminjam.tanggal_pinjam, peminjam.tanggal_balik FROM peminjam
                            LEFT JOIN customer ON peminjam.peminjam_id_customer = customer.id_customer
                            WHERE peminjam.id_peminjam LIKE '%$cari%' OR customer.nama LIKE '%$cari%' OR peminjam.tanggal_pinjam LIKE '%$cari%' OR peminjam.tanggal_balik LIKE '%$cari%'";
                } else {
                    $sql = "SELECT peminjam.id_peminjam, customer.nama AS namapeminjam, peminjam.tanggal_pinjam, peminjam.tanggal_balik FROM peminjam
                            LEFT JOIN customer ON peminjam.peminjam_id_customer = customer.id_customer
                            ORDER BY peminjam.id_peminjam ASC";
                }

                $ambildata = mysqli_query($kon, $sql);
                $num = mysqli_num_rows($ambildata);
            ?>
        <tr>
            <th> ID Peminjam </th>
            <th> Nama Peminjam </th>
            <th> Tanggal Peminjaman </th>
            <th> Tanggal Pengembalian </th>
            <th> Aksi </th>
        </tr>
        <tr>
            <?php 
                while ($userAmbilData = mysqli_fetch_array($ambildata)) {
                    echo "<tr>";
                        echo "<td>" . $id = $userAmbilData['id_peminjam'] . "</td>";
                        echo "<td>" . $namapeminjam = $userAmbilData['namapeminjam'] . "</td>";
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