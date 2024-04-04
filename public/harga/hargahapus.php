<?php 
    include_once("../../config/koneksi.php");

    class HargaController {
        private $kon;

        public function __construct($connection) {
            $this->kon = $connection;
        }
        
        public function deleteHarga($id){
            $deletedata = mysqli_query($this->kon, "DELETE FROM harga WHERE id_harga = '$id'");

            if ($deletedata) {
                return "Data sukses terhapus.";
            } else {
                return "Data gagal terhapus.";
            }
        }
    }

    $hargaController = new HargaController($kon);
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $message = $hargaController->deleteHarga($id);
        echo $message;
        header("Location: dashboard.php");
    }
?>