<?php 
    include_once("../../../config/koneksi.php");

    class HargaController {
        private $kon;

        public function __construct($connection) {
            $this->kon = $connection;
        }

        public function updateHarga($id, $kendaraan_id_motor, $harga_per_hari) {
            $result = mysqli_query($this->kon, "UPDATE harga SET kendaraan_id_motor = '$kendaraan_id_motor', harga_per_hari = '$harga_per_hari' WHERE id_harga = '$id'");
        
            if ($result) {
                return "Sukses meng-update data.";
            } else {
                return "gagal meng-update data.";
            }
        }

        public function getDataHarga($id) {
            $sql = "SELECT * FROM harga WHERE id_harga = '$id'";
            $ambildata = $this->kon->query($sql);

            if ($result = mysqli_fetch_array($ambildata)) {
                return $result;
            } else {
                return null;
            }
        }
    }
?>