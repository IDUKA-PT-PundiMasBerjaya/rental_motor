<?php

    include_once("../../../config/koneksi.php");

    class TambahDataController {
        private $kon;

        public function __construct($connection) {
            $this->kon = $connection;
        }

        public function TambahDataPengembalianMotor($data) {
            $jumlah_array = $data['stok'];
            $tanggal_pengembalian = $data['tanggal_pengembalian'];
            $id_garasi_array = $data['pengembalian_id_garasi'];
            $id_penyewaan = $data['pengembalian_id_penyewaan'];

            foreach ($id_garasi_array as $key => $pengembalian_id_garasi) {
                $jumlah = $jumlah_array[$key];

                if (!is_numeric($jumlah)) {
                    return "Gagal menyimpan data, Jumlah bukan bilangan.";
                }

                $hargaperhariResult = mysqli_query($this->kon, "SELECT harga_per_hari FROM kendaraan WHERE id_motor = '$pengembalian_id_garasi'");
                $hargaperhariRow = mysqli_fetch_assoc($hargaperhariResult);
                $hargaperhari = $hargaperhariRow['harga_per_hari'];

                $result = mysqli_query($this->kon, "SELECT tanggal_balik FROM penyewaan WHERE id_penyewaan = '$id_penyewaan'");
                $row = mysqli_fetch_assoc($result);
                $tanggal_kembali_penyewaan = $row['tanggal_balik'];

                $perbedaan_hari = floor(strtotime($tanggal_pengembalian) - strtotime($tanggal_kembali_penyewaan)) / (60 * 60 * 24);

                $denda = 0;
                if ($perbedaan_hari > 0) {
                    $denda = ($hargaperhari * 1.5) * $perbedaan_hari; 
                }

                $insertData = mysqli_query($this->kon, "INSERT INTO pengembalian(id_pengembalian, stok, tanggal_pengembalian, pengembalian_id_garasi, pengembalian_id_penyewaan, denda)
                                                        VALUES ('$id_penyewaan', '$jumlah', '$tanggal_pengembalian', '$pengembalian_id_garasi', '$id_penyewaan', '$denda')");

                if (!$insertData) {
                    return "Gagal menyimpan data. Error : " . mysqli_error($this->kon);
                }
            }
            return "Data berhasil disimpan.";
        }
    }
?>