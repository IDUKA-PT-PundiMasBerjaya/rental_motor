<?php 
    include_once("../../config/koneksi.php");

    if (isset($_GET['cari'])) {
        $cari = $_GET['cari'];
    }

    $perPage = isset($_GET['perPage']) ? (int)$_GET['perPage'] : 15;
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $start = ($page > 1) ? ($page * $perPage) - $perPage : 0;

    $query = "SELECT pengembalian.id_pengembalian, customer.nama AS namapenyewa,
                penyewaan.tanggal_pinjam, pengembalian.tanggal_pengembalian, 
                CONCAT(kendaraan.brand, ' ', kendaraan.tipe, ' ', kendaraan.tahun) AS motor, 
                pengembalian.stok AS unit, kendaraan.harga_per_hari AS harga, 
                DATEDIFF(pengembalian.tanggal_pengembalian, penyewaan.tanggal_balik) AS telat_hari, 
                DATEDIFF(pengembalian.tanggal_pengembalian, penyewaan.tanggal_balik) * kendaraan.harga_per_hari AS total_harga, 
                kendaraan.gambar_motor AS gambar 
                FROM pengembalian
                JOIN penyewaan 
                ON pengembalian.pengembalian_id_penyewaan = penyewaan.id_penyewaan
                LEFT JOIN customer 
                ON penyewaan.penyewaan_id_customer = customer.id_customer
                JOIN garasi 
                ON pengembalian.pengembalian_id_garasi = garasi.id_garasi
                JOIN kendaraan 
                ON garasi.kendaraan_id_motor = kendaraan.id_motor";

    if (!empty($cari)) {
        $query .= " WHERE penyewaan_motor.id_penyewaan LIKE '%" . $cari . "%'
                    OR customer.nama LIKE '%" . $cari . "%'
                    OR CONCAT(kendaraan.brand, ' ', kendaraan.tipe, ' ', kendaraan.tahun) LIKE '%" . $cari . "%'";
    }

    $query .= " ORDER BY pengembalian.id_pengembalian DESC LIMIT $start, $perPage";
        $ambildata = mysqli_query($kon, $query) or die(mysqli_error($kon));
        $num = mysqli_num_rows($ambildata);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Pengembalian Motor</title>
</head>
<body>
<form action="dashboard.php" method="get">
        <label>Cari: </label>
        <input type="text" name="cari" value="<?php echo isset($_GET['cari']) ? $_GET['cari'] : ''; ?>">
        <input type="submit" value="Cari">
    </form>
    <h1>Data Pengembalian Motor</h1>
    <?php include("controller/tabel_template.php"); ?> <!-- tabel_template -->
    <?php 
        $totalData = mysqli_num_rows(mysqli_query($kon, "SELECT * FROM pengembalian"));
        $totalPage = ceil($totalData / $perPage);
        include("controller/pagination_template.php"); // pagination
    ?>
</body>
</html>