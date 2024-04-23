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
    <link rel="stylesheet" href="../src/output.css">
</head>
<body class="bg-gray-100 p-8">
    <h1 class="flex justify-center text-2xl font-bold mb-4">Dashboard Penyewaan Motor</h1><br>
    <div class="flex justify-center mb-8 space-x-4">
        <a href="garasi/dashboard.php"
            class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded"> Garasi </a>
        <a href="kendaraan/dashboard.php"
            class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded"> List Kendaraan </a>
        <a href="customer/dashboard.php"
            class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded"> Customer </a>
    </div>
    <div class="flex justify-center mb-8 space-x-4">
        <a href="penyewaan/dashboard.php"
            class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded"> Daftar Penyewa </a>
        <a href="penyewaan_motor/dashboard.php"
            class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded"> Penyewaan </a>
        <a href="pengembalian_motor/dashboard.php"
            class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded"> Pengembalian </a>
    </div>
    <div class="flex justify-center">
        <a href="../logout.php"
            class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded"> Logout </a>
    </div>
</body>
</html>