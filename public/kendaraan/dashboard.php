<?php 
include_once("../../config/koneksi.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Kendaraan</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../src/output.css">
</head>
<body class="bg-gray-100 p-8">

<form action="dashboard.php" method="get" class="mb-4">
    <label class="mr-2">Cari:</label>
    <input type="text" name="cari" value="<?php echo isset($_GET['cari']) ? $_GET['cari'] : ''; ?>" class="border border-gray-300 px-3 py-1 rounded-md">
    <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-1 px-3 rounded-md">Cari</button>
</form>

<?php 
if (isset($_GET['cari'])) {
    $cari = $_GET['cari'];
}
?>

<h1 class="text-2xl font-bold mb-4">List Kendaraan</h1>

<div class="mb-4">
    <a href="tambah/tambah.php" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded mr-4">Tambah Data</a>
    <a href="cetak.php" target="_blank" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded mr-4">Cetak</a>
    <a href="../dashboard.php" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">Home</a>
</div>

<table class="border-collapse border border-gray-400 w-full">
    <thead>
        <tr>
            <th class="border border-gray-400 px-4 py-2">ID</th>
            <th class="border border-gray-400 px-4 py-2">Brand</th>
            <th class="border border-gray-400 px-4 py-2">Tipe</th>
            <th class="border border-gray-400 px-4 py-2">Tahun</th>
            <th class="border border-gray-400 px-4 py-2">Warna</th>
            <th class="border border-gray-400 px-4 py-2">Harga</th>
            <th class="border border-gray-400 px-4 py-2">Gambar Motor</th>
            <th class="border border-gray-400 px-4 py-2">Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php 
        if (isset($_GET['cari'])) {
            $cari = $_GET['cari'];
            $ambildata = mysqli_query($kon, "SELECT * FROM kendaraan WHERE id_motor LIKE '%" . $cari . "%' OR brand LIKE '%" . $cari . "%' OR tahun LIKE '%" . $cari . "%'");
        } else {
            $ambildata = mysqli_query($kon, "SELECT * FROM kendaraan ORDER BY id_motor ASC");
            $num = mysqli_num_rows($ambildata);
        }

        if ($ambildata) {
            while ($userAmbilData = mysqli_fetch_array($ambildata)) {
                echo "<tr>";
                echo "<td class='border border-gray-400 px-4 py-2'>" . $userAmbilData['id_motor'] . "</td>";
                echo "<td class='border border-gray-400 px-4 py-2'>" . $userAmbilData['brand'] . "</td>";
                echo "<td class='border border-gray-400 px-4 py-2'>" . $userAmbilData['tipe'] . "</td>";
                echo "<td class='border border-gray-400 px-4 py-2'>" . $userAmbilData['tahun'] . "</td>";
                echo "<td class='border border-gray-400 px-4 py-2'>" . $userAmbilData['warna_motor'] . "</td>";
                echo "<td class='border border-gray-400 px-4 py-2'>Rp. " . $userAmbilData['harga_per_hari'] . "/Hari</td>";
                echo "<td class='border border-gray-400 px-4 py-2'>";
                echo "<a href='javascript:void(0);' onclick=\"window.open('aset/{$userAmbilData['gambar_motor']}', '_blank');\">";
                echo "<img src='aset/{$userAmbilData['gambar_motor']}' alt='Gambar Motor' width='180' height='150'>";
                echo "</a></td>";
                echo "<td class='border border-gray-400 px-4 py-2'>";
                echo "<a href='update/update.php?id=" . $userAmbilData['id_motor'] . "' class='bg-green-600 hover:bg-green-700 text-white font-bold py-1 px-2 rounded'>Update</a>";
                echo "<a href='view/view.php?id=" . $userAmbilData['id_motor'] . "' class='bg-blue-500 hover:bg-blue-600 text-white font-bold py-1 px-2 rounded ml-2'>View</a>";
                echo "<a href='motorhapus.php?id=" . $userAmbilData['id_motor'] . "' class='bg-red-500 hover:bg-red-600 text-white font-bold py-1 px-2 rounded ml-2'>Hapus</a>";
                echo "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td class='border border-gray-400 px-4 py-2' colspan='8'>Data tidak ditemukan.</td></tr>";
        }
        ?>
    </tbody>
</table>

</body>
</html>
