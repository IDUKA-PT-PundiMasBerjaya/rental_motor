<?php 
    include_once("../../../config/koneksi.php");

    class KendaraanController {
        private $kon;

        public function __construct($connection) {
            $this->kon = $connection;
        }

        public function getKendaraanData($id) {
            $result = mysqli_query($this->kon, "SELECT garasi.id_garasi, kendaraan.brand, kendaraan.tipe, kendaraan.tahun,  kendaraan.warna_motor, kendaraan.gambar_motor AS gambar_motor, garasi.stok
                                                FROM kendaraan
                                                INNER JOIN garasi
                                                ON kendaraan.id_motor = garasi.kendaraan_id_motor
                                                WHERE id_garasi = '$id'");
            return mysqli_fetch_array($result);
        }
    }

    $garasiController = new KendaraanController($kon);
    $id = $_GET['id'];
    $kendaraanData = $garasiController->getKendaraanData($id);

    if ($kendaraanData) {
        $id = $kendaraanData['id_garasi'];
        $brand = $kendaraanData['brand'];
        $tipe = $kendaraanData['tipe'];
        $tahun = $kendaraanData['tahun'];
        $warna_motor = $kendaraanData['warna_motor'];
        $stok = $kendaraanData['stok'];
        $gambar_motor = $kendaraanData['gambar_motor'];
    }
?>