<?php 
    include_once("../../../config/koneksi.php");

    class MotorController {
        private $kon;

        public function __construct($connection) {
            $this->kon = $connection;
        }

        public function updateMotor($id, $brand, $tipe, $tahun, $warna_motor) {
            $result = mysqli_query($this->kon, "UPDATE kendaraan SET brand = '$brand', tipe = '$tipe', tahun = '$tahun', warna_motor = '$warna_motor' WHERE id_motor = '$id'");
        
            if ($result) {
                return "Sukses meng-update data.";
            } else {
                return "gagal meng-update data.";
            }
        }

        public function getDataMotor($id) {
            $sql = "SELECT * FROM kendaraan WHERE id_motor = '$id'";
            $ambildata = $this->kon->query($sql);

            if ($result = mysqli_fetch_array($ambildata)) {
                return $result;
            } else {
                return null;
            }
        }
    }
?>