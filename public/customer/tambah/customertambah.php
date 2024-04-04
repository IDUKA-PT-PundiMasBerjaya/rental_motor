<?php 
    include_once("../../../config/koneksi.php");

    class CustomerController {
        private $kon;

        public function __construct($connection) {
            $this->kon = $connection;
        }

        public function tambahCustomer() {
            $setAuto = mysqli_query($this->kon, "SELECT MAX(id_customer) AS max_id FROM customer");
            $result = mysqli_fetch_assoc($setAuto);
            $max_id = $result['max_id'];

            if(is_numeric($max_id)) {
                $nounik = $max_id + 1;
            } else {
                $nounik = 1;
            } return $nounik;
        }

        public function tambahDataCustomer($data) {
            $id = $data['id_customer'];
            $nama = $data['nama'];
            $email = $data['email'];
            $no_telp = $data['no_telp'];
            $alamat = $data['alamat'];

            $insertData = mysqli_query($this->kon, "INSERT INTO customer(id_customer, nama, email, no_telp, alamat)
                                                    VALUES ('$id', '$nama', '$email', '$no_telp', '$alamat')");

            if ($insertData) {
                return "Data berhasil disimpan.";
            } else {
                return "Gagal menyimpan data.";
            }
        }
    }
?>