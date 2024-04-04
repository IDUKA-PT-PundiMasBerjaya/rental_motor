<?php 
    include_once("../../../config/koneksi.php");

    class CustomerController {
        private $kon;

        public function __construct($connection) {
            $this->kon = $connection;
        }

        public function updateCustomer($id, $nama, $email, $no_telp, $alamat) {
            $result = mysqli_query($this->kon, "UPDATE customer SET nama = '$nama', email = '$email', no_telp = '$no_telp', alamat = '$alamat' WHERE id_customer = '$id'");
        
            if ($result) {
                return "Sukses meng-update data.";
            } else {
                return "gagal meng-update data.";
            }
        }

        public function getDataCustomer($id) {
            $sql = "SELECT * FROM customer WHERE id_customer = '$id'";
            $ambildata = $this->kon->query($sql);

            if ($result = mysqli_fetch_array($ambildata)) {
                return $result;
            } else {
                return null;
            }
        }
    }
?>