<?php 
    include_once("../../../config/koneksi.php");

    if (isset($_POST['cari'])) {
        $cari = $_GET['cari'];
    }

    $perPage = isset($_GET['perPage']) ? (int)$_GET['perPage'] : 15;
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $start = ($page > 1) ? ($page * $perPage) - $perPage : 0;

    
?>