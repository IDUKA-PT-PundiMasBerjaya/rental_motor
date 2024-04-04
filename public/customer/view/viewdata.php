<?php 
    include_once("../../../config/koneksi.php");

    class CustomerController {
        private $kon;

        public function __construct($connection) {
            $this->kon = $connection;
        }
        
        public function getCustomerData($id) {
            $result = mysqli_query($this->kon, "SELECT * FROM customer WHERE id_customer = '$id'");
            return mysqli_fetch_array($result);
        }
    }

    $customerController = new CustomerController($kon);
    $id = $_GET['id'];
    $customerData = $customerController->getCustomerData($id);

    if ($customerData) {
        $id = $customerData['id_customer'];
        $nama = $customerData['nama'];
        $email = $customerData['email'];
        $no_telp = $customerData['no_telp'];
        $alamat = $customerData['alamat'];
    }
?>