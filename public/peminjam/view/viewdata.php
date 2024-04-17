<?php 
    include_once("../../../config/koneksi.php");

    class PeminjamController {
        private $kon;

        public function __construct($connection) {
            $this->kon = $connection;
        }

        public function getPeminjamData($id) {
            $result = mysqli_query($this->kon, "SELECT peminjam.id_peminjam, customer.nama AS namapeminjam, peminjam.tanggal_pinjam, peminjam.tanggal_balik FROM peminjam
                                                LEFT JOIN customer ON peminjam.peminjam_id_customer = customer.id_customer
                                                WHERE peminjam.id_peminjam = '$id'");
            return mysqli_fetch_array($result);
        }
    }

    $garasiController = new PeminjamController($kon);
    $id = $_GET['id'];
    $PeminjamData = $garasiController->getPeminjamData($id);

    if ($PeminjamData) {
        $id = $PeminjamData['id_peminjam'];
        $namapeminjam = $PeminjamData['namapeminjam'];
        $tanggal_pinjam = $PeminjamData['tanggal_pinjam'];
        $tanggal_balik = $PeminjamData['tanggal_balik'];
    }
?>