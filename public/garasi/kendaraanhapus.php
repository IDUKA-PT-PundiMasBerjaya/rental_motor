<?php 
    include_once("../../config/koneksi.php");

    class KendaraanController {
        private $kon;

        public function __construct($connection) {
            $this->kon = $connection;
        }
        
        public function deleteKendaraan($id){
            $deletedata = mysqli_query($this->kon, "DELETE FROM garasi WHERE id_garasi = '$id'");

            if ($deletedata) {
                return "Data sukses terhapus.";
            } else {
                return "Data gagal terhapus.";
            }
        }
    }

    $garasiController = new KendaraanController($kon);
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $message = $garasiController->deleteKendaraan($id);
        echo $message;
        header("Location: dashboard.php");
    }
?>