<?php 
    include_once("../../../config/koneksi.php");

    class MotorController {
        private $kon;

        public function __construct($connection) {
            $this->kon = $connection;
        }
        
        public function getMotorData($id) {
            $result = mysqli_query($this->kon, "SELECT * FROM kendaraan WHERE id_motor = '$id'");
            return mysqli_fetch_array($result);
        }
    }

    $kendaraanController = new MotorController($kon);
    $id = $_GET['id'];
    $motorData = $kendaraanController->getMotorData($id);

    if ($motorData) {
        $id = $motorData['id_motor'];
        $brand = $motorData['brand'];
        $tipe = $motorData['tipe'];
        $tahun = $motorData['tahun'];
        $warna_motor = $motorData['warna_motor'];
        $harga_per_hari = $motorData['harga_per_hari'];
        $gambar_motor = $motorData['gambar_motor'];
    }
?>