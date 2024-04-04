<?php 
    include_once("../../../config/koneksi.php");

    class MotorController {
        private $kon;

        public function __construct($connection) {
            $this->kon = $connection;
        }

        public function tambahMotor() {
            $setAuto = mysqli_query($this->kon, "SELECT MAX(id_motor) AS max_id FROM kendaraan");
            $result = mysqli_fetch_assoc($setAuto);
            $max_id = $result['max_id'];

            if(is_numeric($max_id)) {
                $nounik = $max_id + 1;
            } else {
                $nounik = 1;
            } return $nounik;
        }

        public function tambahDataMotor($data) {
            $id = $data['id_motor'];
            $brand = $data['brand'];
            $tipe = $data['tipe'];
            $tahun = $data['tahun'];
            $warna_motor = $data['warna_motor'];

            $ekstensi_diperbolehkan = array('jpeg', 'jpg', 'png');
            $namagambar = $_FILES['gambar_motor']['name'];
            $x = explode('.', $namagambar);
            $ekstensi = strtolower(end($x));
            $ukuran = $_FILES['gambar_motor']['size'];
            $file_temp = $_FILES['gambar_motor']['tmp_name'];

            if (in_array($ekstensi, $ekstensi_diperbolehkan) === true) {
                if ($ukuran <= 2000000) {
                    move_uploaded_file($file_temp, '../aset/' . $namagambar);
                    $insertData = mysqli_query($this->kon, "INSERT INTO kendaraan(id_motor, brand, tipe, tahun, warna_motor, gambar_motor)
                                                            VALUES ('$id', '$brand', '$tipe', '$tahun', '$warna_motor', '$namagambar')");

                    if ($insertData) {
                        return "Data berhasil disimpan.";
                    } else {
                        return "Gagal menyimpan data.";
                    }
                } else {
                    echo "<div style='color: red'>
                            Ukuran file terlalu besar! Silahkan pilih file yang lebih kecil!    
                        </div>";
                }
            } else {
                echo "<div style='color: red'>
                            Ekstensi file yang di upload tidadk diizinkan!   
                        </div>";
            }
        }
    }
?>