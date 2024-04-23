<?php 
include_once("../../config/koneksi.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Penyewaan</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 p-8">

<form action="dashboard.php" method="get" class="mb-4">
    <label class="mr-2">Cari :</label>
    <input type="text" name="cari" value="<?php echo isset($_GET['cari']) ? $_GET['cari'] : ''; ?>" class="border border-gray-300 px-3 py-1 rounded-md">
    <button type="submit" name="Cari" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-1 px-3 rounded-md">Cari</button>
</form>

<?php 
if (isset($_GET['cari'])) {
    $cari = $_GET['cari'];
}
?>

<h1 class="text-2xl font-bold mb-4">Data Penyewaan</h1>

<div class="mb-4">
    <a href="tambah/tambah.php" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded mr-4">Tambah Data</a>
    <a href="cetak.php" target="_blank" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded mr-4">Cetak</a>
    <a href="../dashboard.php" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">Home</a>
</div>

<table class="border-collapse border border-gray-400 w-full">
    <thead>
        <tr>
            <th class="border border-gray-400 px-4 py-2">ID Penyewaan</th>
            <th class="border border-gray-400 px-4 py-2">Nama Penyewa</th>
            <th class="border border-gray-400 px-4 py-2">Tanggal Peminjaman</th>
            <th class="border border-gray-400 px-4 py-2">Tanggal Pengembalian</th>
            <th class="border border-gray-400 px-4 py-2">Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php 
        if (isset($_GET['cari'])) {
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

        while ($userAmbilData = mysqli_fetch_array($ambildata)) {
            echo "<tr>";
            echo "<td class='border border-gray-400 px-4 py-2'>" . $userAmbilData['id_penyewaan'] . "</td>";
            echo "<td class='border border-gray-400 px-4 py-2'>" . $userAmbilData['namapenyewa'] . "</td>";
            echo "<td class='border border-gray-400 px-4 py-2'>" . $userAmbilData['tanggal_pinjam'] . "</td>";
            echo "<td class='border border-gray-400 px-4 py-2'>" . $userAmbilData['tanggal_balik'] . "</td>";
            echo "<td class='border border-gray-400 px-4 py-2'>";
            echo "<a href='view/view.php?id=" . $userAmbilData['id_penyewaan'] . "' class='bg-blue-500 hover:bg-blue-600 text-white font-bold py-1 px-2 rounded'>View</a>";
            echo "</td>";
            echo "</tr>";
        }

        if (mysqli_num_rows($ambildata) == 0) {
            echo "<tr><td class='border border-gray-400 px-4 py-2' colspan='5'>Data tidak ditemukan.</td></tr>";
        }
        ?>
    </tbody>
</table>

</body>
</html>
