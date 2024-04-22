<?php 
    include_once("../../../config/koneksi.php");

    class PenyewaanController {
        private $kon;

        public function __construct($connection) {
            $this->kon = $connection;
        }

        public function getPenyewaanData($id) {
            $result = mysqli_query($this->kon, "SELECT penyewaan.id_penyewaan, customer.nama AS namapenyewa, penyewaan.tanggal_pinjam, penyewaan.tanggal_balik FROM penyewaan
                                                LEFT JOIN customer ON penyewaan.penyewaan_id_customer = customer.id_customer
                                                WHERE penyewaan.id_penyewaan = '$id'");
            return mysqli_fetch_array($result);
        }
    }

    $garasiController = new PenyewaanController($kon);
    $id = $_GET['id'];
    $PenyewaanData = $garasiController->getPenyewaanData($id);

    if ($PenyewaanData) {
        $id = $PenyewaanData['id_penyewaan'];
        $namapenyewa = $PenyewaanData['namapenyewa'];
        $tanggal_pinjam = $PenyewaanData['tanggal_pinjam'];
        $tanggal_balik = $PenyewaanData['tanggal_balik'];
    }
?>