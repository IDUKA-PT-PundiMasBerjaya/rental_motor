<?php 
    include_once("../config/koneksi.php");

    session_start();

    if (!isset($_SESSION['user_id'])) {
        header("Location: ../login.php");
        exit();
    }

    $user_id = $_SESSION['user_id'];
    $username = $_SESSION['username'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Penyewaan Motor</title>
</head>
<body>
    <h1>Dashboard Penyewaan Motor</h1>
    |<a href="garasi/dashboard.php"> Garasi </a>|
    |<a href="kendaraan/dashboard.php"> List Kendaraan </a>|
    |<a href="harga/dashboard.php"> List Harga </a>|
    <br><br>
    |<a href="customer/dashboard.php"> Customer </a>|
    |<a href="peminjaman/dashboard/dashboard.php"> Penyewaan </a>|
    |<a href=""> Pengembalian </a>|
    <br><br>
    |<a href="../logout.php"> Logout </a>|
</body>
</html>