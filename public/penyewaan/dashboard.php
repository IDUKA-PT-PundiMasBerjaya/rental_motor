<?php 
    include_once("../../config/koneksi.php");

    if (isset($_GET['cari'])) {
        $cari = $_GET['cari'];
    }

    $perPage = isset($_GET['perPage']) ? (int)$_GET['perPage'] : 15;
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $start = ($page > 1) ? ($page * $perPage) - $perPage : 0;

    $query = "SELECT penyewaan.id_penyewaan, customer.nama AS namapeminjam, 
                CONCAT(kendaraan.brand, ' ', kendaraan.tipe, ' ', kendaraan.tahun) AS motor, 
                peminjam.tanggal_pinjam, peminjam.tanggal_balik, kendaraan.harga_per_hari, 
                kendaraan.gambar_motor AS gambar
                FROM 
                penyewaan
                JOIN 
                peminjam ON penyewaan.id_penyewaan = peminjam.peminjam_id_customer
                JOIN 
                customer ON peminjam.peminjam_id_customer = customer.id_customer
                JOIN
                kendaraan ON penyewaan.penyewaan_id_motor = kendaraan.id_motor";

    if (!empty($cari)) {
        $query .= " WHERE penyewaan.id_penyewaan LIKE '%" . $cari . "%'
                    OR customer.nama LIKE '%" . $cari . "%'
                    OR CONCAT(kendaraan.brand, ' ', kendaraan.tipe, ' ', kendaraan.tahun) LIKE '%" . $cari . "%'
                    OR peminjam.tanggal_pinjam LIKE '%" . $cari . "%'
                    OR peminjam.tanggal_balik LIKE '%" . $cari . "%'";
    }

    $query .= " ORDER BY penyewaan.id_penyewaan DESC LIMIT $start, $perPage";
    $ambildata = mysqli_query($kon, $query) or die(mysqli_error($kon));
    $num = mysqli_num_rows($ambildata);
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
        <label>Cari: </label>
        <input type="text" name="cari" value="<?php echo isset($_GET['cari']) ? $_GET['cari'] : ''; ?>">
        <input type="submit" value="Cari">
    </form>
    <h1>Data Penyewaan</h1>
    <?php include("controller/tabel_template.php"); ?> <!-- tabel_template -->
    <?php 
        $totalData = mysqli_num_rows(mysqli_query($kon, "SELECT * FROM penyewaan"));
        $totalPage = ceil($totalData / $perPage);
        include("controller/pagination_template.php"); // pagination
    ?>
</body>
</html>