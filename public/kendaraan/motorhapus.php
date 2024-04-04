<?php 
    include_once("../../config/koneksi.php");

    class MotorController {
        private $kon;

        public function __construct($connection) {
            $this->kon = $connection;
        }
        
        public function deleteMotor($id) {
            $result = mysqli_query($this->kon, "SELECT gambar_motor FROM kendaraan WHERE id_motor = '$id'");
            $row = mysqli_fetch_assoc($result);
            $gambar_motor = $row['gambar_motor'];

            $deletedata = mysqli_query($this->kon, "DELETE FROM kendaraan WHERE id_motor = '$id'");

            if ($deletedata) {
                $gambar_dir = "aset/";

                if ($gambar_motor && file_exists($gambar_dir . $gambar_motor)) {
                    unlink($gambar_dir . $gambar_motor);
                }
                return "Data sukses terhapus.";
            } else {
                return "Data gagal terhapus.";
            }
        }
    }

    $kendaraanController = new MotorController($kon);

    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $message = $kendaraanController->deleteMotor($id);
        echo $message;
        header("Location: dashboard.php");
    }
?>