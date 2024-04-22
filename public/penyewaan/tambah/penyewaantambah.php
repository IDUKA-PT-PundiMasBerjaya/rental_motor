<?php 
    include_once("../../../config/koneksi.php");

    class PenyewaanController {
        private $kon;

        public function __construct($connection) {
            $this->kon = $connection;
        }

        public function tambahPenyewaan() {
            $setAuto = mysqli_query($this->kon, "SELECT MAX(id_penyewaan) AS max_id FROM penyewaan");
            $result = mysqli_fetch_assoc($setAuto);
            $max_id = $result['max_id'];

            if (is_numeric($max_id)) {
                $nounik = $max_id + 1;
            } else {
                $nounik = 1;
            } return $nounik;
        }

        public function tambahDataPenyewaan($data) {
            $id_penyewaan = $data['id_penyewaan'];
            $penyewaan_id_customer = $data['penyewaan_id_customer'];
            $tanggal_pinjam = $data['tanggal_pinjam'];
            $tanggal_balik = $data['tanggal_balik'];

            $insertData = mysqli_query($this->kon, "INSERT INTO penyewaan(id_penyewaan, penyewaan_id_customer, tanggal_pinjam, tanggal_balik) VALUES ('$id_penyewaan', '$penyewaan_id_customer', '$tanggal_pinjam', '$tanggal_balik')");

            if ($insertData ) {
                return "Data berhasil disimpan.";
            } else {
                return "gagal menyimpan data.";
            }
        }
    }
?>