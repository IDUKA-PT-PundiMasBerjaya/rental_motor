<?php 
    include_once("../../../config/koneksi.php");

    class TambahMotorController { 
        private $kon;

        public function __construct($connection) {
            $this->kon = $connection;
        }

        public function TambahDataPenyewaanMotor($data) {
            $id_penyewaan = $data['id_penyewaan'];
            $jumlah_array = $data['stok'];
            $id_garasi_array = $data['penyewaan_id_garasi']; 

            if (empty($id_penyewaan) || !is_numeric($id_penyewaan)) {
                return "Gagal menyimpan data, ID Penyewa tidak valid";
            }

            foreach ($id_garasi_array as $key => $penyewaan_id_garasi) { 
                $jumlah = $jumlah_array[$key];

                if (!is_numeric($jumlah)) {
                    return "Gagal menyimpan data, Jumlah harus berupa angka";
                }

                $stokMotor = $this->cekStockMotor($penyewaan_id_garasi, $jumlah);
                if ($stokMotor === false) {
                    return "Stok motor tidak mencukupi";
                }

                $insertData = mysqli_query($this->kon, "INSERT INTO penyewaan_motor (id_penyewaan, penyewaan_id_garasi, stok)
                                                        VALUES ('$id_penyewaan', '$penyewaan_id_garasi', '$jumlah')");

                if (!$insertData) {
                    return "Gagal menyimpan data, Error : " . mysqli_error($this->kon);
                }
            }
            return "Data berhasil disimpan";
        }

        public function cekStockMotor($penyewaan_id_garasi, $jumlah) {
            $query = mysqli_query($this->kon, "SELECT stok FROM garasi WHERE id_garasi = '$penyewaan_id_garasi'");
            $data = mysqli_fetch_assoc($query);

            if ($data['stok'] >= $jumlah) {
                return true;
            } else {
                return false;
            }
        }
    }
?>