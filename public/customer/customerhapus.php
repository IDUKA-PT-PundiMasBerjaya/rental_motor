<?php 
    include_once("../../config/koneksi.php");

    class CustomerController {
        private $kon;

        public function __construct($connection) {
            $this->kon = $connection;
        }
        
        public function deleteCustomer($id) {
            $deletedata = mysqli_query($this->kon, "DELETE FROM customer WHERE id_customer = '$id'");

            if ($deletedata) {
                return "Data sukses terhapus.";
            } else {
                return "Data gagal terhapus.";
            }
        }
    }

    $customerController = new CustomerController($kon);

    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $message = $customerController->deleteCustomer($id);
        echo $message;
        header("Location: dashboard.php");
    }
?>