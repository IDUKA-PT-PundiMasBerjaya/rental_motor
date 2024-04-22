<?php 
    include_once("../../../config/koneksi.php");

    class KendaraanController {
        private $kon;

        public function __construct($connection) {
            $this->kon = $connection;
        }

        public function TambahKendaraan() {
            $setAuto = mysqli_query($this->kon, "SELECT MAX(id_garasi) AS max_id FROM garasi");
            $result = mysqli_fetch_assoc($setAuto);
            $max_id = $result['max_id'];

            if (is_numeric($max_id)) {
                $nounik = $max_id + 1;
            } else {
                $nounik = 1;;
            } return $nounik;
        }

        public function tambahDataKendaraan($data) {
            $id = $data['id_garasi'];
            $kendaraan_id_motor = $data['kendaraan_id_motor'];
            $stok = $data['stok'];

            $insertData = mysqli_query($this->kon, "INSERT INTO garasi(id_garasi, kendaraan_id_motor, stok) VALUES ('$id', '$kendaraan_id_motor', '$stok')");
            
            if ($insertData) {
                return "Data berhasil disimpan.";
            } else {
                return "gagal menyimpan data.";
            }
        }
    }
?>