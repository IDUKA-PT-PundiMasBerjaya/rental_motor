<?php 
    include_once("../../../config/koneksi.php");

    class PeminjamController {
        private $kon;

        public function __construct($connection) {
            $this->kon = $connection;
        }

        public function tambahPeminjam() {
            $setAuto = mysqli_query($this->kon, "SELECT MAX(id_peminjam) AS max_id FROM peminjam");
            $result = mysqli_fetch_assoc($setAuto);
            $max_id = $result['max_id'];

            if (is_numeric($max_id)) {
                $nounik = $max_id + 1;
            } else {
                $nounik = 1;
            } return $nounik;
        }

        public function tambahDataPeminjam($data) {
            $id_peminjam = $data['id_peminjam'];
            $peminjam_id_customer = $data['peminjam_id_customer'];
            $tanggal_pinjam = $data['tanggal_pinjam'];
            $tanggal_balik = $data['tanggal_balik'];

            $insertData = mysqli_query($this->kon, "INSERT INTO peminjam(id_peminjam, peminjam_id_customer, tanggal_pinjam, tanggal_balik) VALUES ('$id_peminjam', '$peminjam_id_customer', '$tanggal_pinjam', '$tanggal_balik')");

            if ($insertData ) {
                return "Data berhasil disimpan.";
            } else {
                return "gagal menyimpan data.";
            }
        }
    }
?>