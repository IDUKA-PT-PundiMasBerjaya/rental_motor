<?php 
    include_once("../../../config/koneksi.php");

    class HargaController {
        private $kon;

        public function __construct($connection) {
            $this->kon = $connection;
        }

        public function getHargaData($id) {
            $result = mysqli_query($this->kon, "SELECT harga.id_harga, kendaraan.brand, kendaraan.tipe, kendaraan.tahun,  kendaraan.warna, kendaraan.gambar_motor AS gambar_motor, harga.harga_per_hari
                                                FROM kendaraan
                                                INNER JOIN harga
                                                ON kendaraan.id_motor = harga.id_motor
                                                WHERE id_harga = '$id'");
            return mysqli_fetch_array($result);
        }
    }

    $hargaController = new HargaController($kon);
    $id = $_GET['id'];
    $hargaData = $hargaController->getHargaData($id);

    if ($hargaData) {
        $id = $hargaData['id_harga'];
        $brand = $hargaData['brand'];
        $tipe = $hargaData['tipe'];
        $tahun = $hargaData['tahun'];
        $warna = $hargaData['warna'];
        $harga_per_hari = $hargaData['harga_per_hari'];
        $gambar_motor = $hargaData['gambar_motor'];
    }
?>