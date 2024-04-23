<?php 
include_once("../../config/koneksi.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Garasi</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../src/output.css">
</head>

<body class="bg-gray-100 p-8">
    <form action="dashboard.php" method="get" class="mb-4">
        <label class="mr-2">Cari:</label>
        <input type="text" name="cari" class="border border-gray-300 px-3 py-1 rounded-md">
        <button type="submit" name="Cari"
            class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-1 px-3 rounded-md">Cari</button>
    </form>

    <?php 
    if (isset($_GET['cari'])) {
        $cari = $_GET['cari'];
    }
    ?>
    <h1 class="text-2xl font-bold mb-4">Data Garasi</h1>

    <div class="mb-4">
        <a href="tambah/tambah.php"
            class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded mr-4">Tambah Garasi</a>
        <a href="cetak.php" target="_blank"
            class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded mr-4">Cetak</a>
        <a href="../dashboard.php" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">Home</a>
    </div>

    <table class="border-collapse border border-gray-400 w-full">
        <tr>
            <th class="border border-gray-400 px-4 py-2">ID Garasi</th>
            <th class="border border-gray-400 px-4 py-2">Brand</th>
            <th class="border border-gray-400 px-4 py-2">Tipe</th>
            <th class="border border-gray-400 px-4 py-2">Tahun</th>
            <th class="border border-gray-400 px-4 py-2">Warna</th>
            <th class="border border-gray-400 px-4 py-2">Stok Motor</th>
            <th class="border border-gray-400 px-4 py-2">Gambar Motor</th>
            <th class="border border-gray-400 px-4 py-2">Aksi</th>
        </tr>
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

        if ($ambildata) {
            while ($userAmbilData = mysqli_fetch_array($ambildata)) {
                echo "<tr>";
                echo "<td class='border border-gray-400 px-4 py-2'>" . $id = $userAmbilData['id_garasi'] . "</td>";
                echo "<td class='border border-gray-400 px-4 py-2'>" . $brand = $userAmbilData['brand'] . "</td>";
                echo "<td class='border border-gray-400 px-4 py-2'>" . $tipe = $userAmbilData['tipe'] . "</td>";
                echo "<td class='border border-gray-400 px-4 py-2'>" . $tahun = $userAmbilData['tahun'] . "</td>";
                echo "<td class='border border-gray-400 px-4 py-2'>" . $warna = $userAmbilData['warna_motor'] . "</td>";
                echo "<td class='border border-gray-400 px-4 py-2'>" . $warna = $userAmbilData['stok'] . "</td>";
                echo "<td class='border border-gray-400 px-4 py-2'><img src='../kendaraan/aset/" . $userAmbilData['gambar_motor'] . "' alt='Gambar Motor' width='180' height='150'></td>";
                echo "<td class='border border-gray-400 px-4 py-2'>
                        <a href='view/view.php?id=" . $id . "' class='bg-blue-500 hover:bg-blue-600 text-white font-bold py-1 px-2 rounded'>View</a>
                        <a href='kendaraanhapus.php?id=" . $id . "' class='bg-red-500 hover:bg-red-600 text-white font-bold py-1 px-2 rounded ml-2'>Hapus</a>
                    </td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td class='border border-gray-400 px-4 py-2' colspan='8'>Data tidak ditemukan.</td></tr>";
        }
        ?>
    </table>
</body>

</html>
