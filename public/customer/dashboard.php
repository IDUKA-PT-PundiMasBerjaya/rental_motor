<?php 
include_once("../../config/koneksi.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Customer</title>
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

<h1 class="text-2xl font-bold mb-4">Data Customer</h1>

<div class="mb-4">
    <a href="tambah/tambah.php" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded mr-4">Tambah Data</a>
    <a href="cetak.php" target="_blank" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded mr-4">Cetak</a>
    <a href="../dashboard.php" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">Home</a>
</div>

<table class="border-collapse border border-gray-400 w-full">
    <thead>
        <tr>
            <th class="border border-gray-400 px-4 py-2">ID</th>
            <th class="border border-gray-400 px-4 py-2">Nama</th>
            <th class="border border-gray-400 px-4 py-2">Email</th>
            <th class="border border-gray-400 px-4 py-2">No. Telp</th>
            <th class="border border-gray-400 px-4 py-2">Alamat</th>
            <th class="border border-gray-400 px-4 py-2">Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php 
        if (isset($_GET['cari'])) {
            $query = "SELECT * FROM customer WHERE id_customer LIKE '%$cari%' OR nama LIKE '%$cari%' OR email LIKE '%$cari%'";
        } else {
            $query = "SELECT * FROM customer ORDER BY id_customer ASC";
        }
        
        $ambildata = mysqli_query($kon, $query);
        
        if ($ambildata) {
            while ($userAmbilData = mysqli_fetch_array($ambildata)) {
                echo "<tr>";
                echo "<td class='border border-gray-400 px-4 py-2'>" . $userAmbilData['id_customer'] . "</td>";
                echo "<td class='border border-gray-400 px-4 py-2'>" . $userAmbilData['nama'] . "</td>";
                echo "<td class='border border-gray-400 px-4 py-2'>" . $userAmbilData['email'] . "</td>";
                echo "<td class='border border-gray-400 px-4 py-2'>" . $userAmbilData['no_telp'] . "</td>";
                echo "<td class='border border-gray-400 px-4 py-2'>" . $userAmbilData['alamat'] . "</td>";
                echo "<td class='border border-gray-400 px-4 py-2'>";
                echo "<a href='update/update.php?id=" . $userAmbilData['id_customer'] . "' class='bg-green-600 hover:bg-green-700 text-white font-bold py-1 px-2 rounded'>Update</a>";
                echo "<a href='view/view.php?id=" . $userAmbilData['id_customer'] . "' class='bg-blue-500 hover:bg-blue-600 text-white font-bold py-1 px-2 rounded ml-2'>View</a>";
                echo "<a href='customerhapus.php?id=" . $userAmbilData['id_customer'] . "' class='bg-red-500 hover:bg-red-600 text-white font-bold py-1 px-2 rounded ml-2'>Hapus</a>";
                echo "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td class='border border-gray-400 px-4 py-2' colspan='6'>Data tidak ditemukan.</td></tr>";
        }
        ?>
    </tbody>
</table>

</body>
</html>
