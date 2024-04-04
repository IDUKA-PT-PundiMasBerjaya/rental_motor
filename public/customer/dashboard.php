<?php 
    include_once("../../config/koneksi.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Customer</title>
</head>
<body>
    <form action="dashboard.php" method="get">
        <label>Cari: </label>
        <input type="text" name="cari">
        <input type="submit" value="Cari">
    </form>
    <?php 
        if (isset($_GET['cari'])) {
            $cari = $_GET['cari'];
        }
    ?>
    <table border="1">
        <h1>Data Customer</h1>
        |<a href="tambah/tambah.php"> Tambah Data </a>|
        |<a href="cetak.php" target="_blank"> Cetak </a>|
        |<a href="../dashboard.php"> Home </a>|
        <tr>
            <th>ID</th>
            <th>Nama</th>
            <th>Email</th>
            <th>No. Telp</th>
            <th>Alamat</th>
            <th>Aksi</th>
        </tr>
        <?php 
            if (isset($_GET['cari'])) {
                $query = "SELECT * FROM customer
                            WHERE id_customer LIKE '%$cari%' OR nama LIKE '%$cari%' OR email LIKE '%$cari%'";
            } else {
                $query = "SELECT * FROM customer ORDER BY id_customer ASC";
            }
            
            $ambildata = mysqli_query($kon, $query);
            
            if ($ambildata) {
                while ($userAmbilData = mysqli_fetch_array($ambildata)) {
                    echo "<tr>";
                        echo "<td>" . $id = $userAmbilData['id_customer'] . "</td>";
                        echo "<td>" . $nama = $userAmbilData['nama'] . "</td>";
                        echo "<td>" . $email = $userAmbilData['email'] . "</td>";
                        echo "<td>" . $no_telp = $userAmbilData['no_telp'] . "</td>";
                        echo "<td>" . $alamat = $userAmbilData['alamat'] . "</td>";
                        echo "<td>
                                |<a href='update/update.php?id=" . $userAmbilData['id_customer'] . "'>Update</a>|
                                |<a href='view/view.php?id=" . $userAmbilData['id_customer'] . "'>View</a>|
                                |<a href='customerhapus.php?id=" . $userAmbilData['id_customer'] . "'>Hapus</a>|
                            </td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='6'>Data tidak ditemukan.</td></tr>";
            }
        ?>
    </table>
</body>
</html>
