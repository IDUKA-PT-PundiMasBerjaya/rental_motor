<?php 
    include_once("../../config/koneksi.php");

    if (isset($_GET['cari'])) {
        $cari = $_GET['cari'];
    }

    $perPage = isset($_GET['perPage']) ? (int)$_GET['perPage'] : 15;
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $start = ($page > 1) ? ($page * $perPage) - $perPage : 0;

    $query = "SELECT penyewaan_motor.id_penyewaan, 
                CASE 
                    WHEN customer.nama IS NOT NULL THEN customer.nama 
                END AS namapenyewa,
                penyewaan.tanggal_pinjam, penyewaan.tanggal_balik, 
                CONCAT(kendaraan.brand, ' ', kendaraan.tipe, ' ', kendaraan.tahun) AS motor,  
                penyewaan_motor.stok AS unit, kendaraan.harga_per_hari AS harga, 
                kendaraan.gambar_motor AS gambar 
                FROM penyewaan_motor
                JOIN penyewaan 
                ON penyewaan_motor.id_penyewaan = penyewaan.id_penyewaan
                LEFT JOIN customer 
                ON penyewaan.penyewaan_id_customer = customer.id_customer
                JOIN garasi 
                ON penyewaan_motor.penyewaan_id_garasi = garasi.id_garasi
                JOIN kendaraan 
                ON garasi.kendaraan_id_motor = kendaraan.id_motor";

    if (!empty($cari)) {
        $query .= " WHERE penyewaan_motor.id_penyewaan LIKE '%" . $cari . "%'
                    OR customer.nama LIKE '%" . $cari . "%'
                    OR CONCAT(kendaraan.brand, ' ', kendaraan.tipe, ' ', kendaraan.tahun) LIKE '%" . $cari . "%'
                    OR penyewaan.tanggal_pinjam LIKE '%" . $cari . "%'
                    OR penyewaan.tanggal_balik LIKE '%" . $cari . "%'";
    }

    $query .= " ORDER BY penyewaan_motor.id_penyewaan DESC LIMIT $start, $perPage";
    $ambildata = mysqli_query($kon, $query) or die(mysqli_error($kon));
    $num = mysqli_num_rows($ambildata);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Penyewaan Motor</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../src/output.css">
</head>
<body class="bg-gray-100 p-8">
    <form action="dashboard.php" method="get" class="mb-4">
        <label class="mr-2">Cari: </label>
        <input type="text" name="cari" class="border border-gray-300 px-3 py-1 rounded-md" value="<?php echo isset($_GET['cari']) ? $_GET['cari'] : ''; ?>">
        <input type="submit" value="Cari" 
            class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-1 px-3 rounded-md">
    </form>
    <h1 class="text-2xl font-bold mb-4">Data Penyewaan Motor</h1>
    <?php include("controller/tabel_template.php"); ?> <!-- tabel_template -->
    <?php 
        $totalData = mysqli_num_rows(mysqli_query($kon, "SELECT * FROM penyewaan_motor"));
        $totalPage = ceil($totalData / $perPage);
        include("controller/pagination_template.php"); // pagination
    ?>
</body>
</html>