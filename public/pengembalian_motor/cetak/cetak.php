<?php
    include_once("../../../config/koneksi.php");
    require("../../../library/fpdf.php");

    $pdf = new FPDF('L', 'mm', 'A4');
    $pdf->AddPage();

    $pdf->SetFont('Times', 'B', 13);
    $pdf->Cell(0, 15, '', 0, 1);
    $id_pengembalian = $_GET['id_pengembalian'];
    $data = "SELECT customer.nama AS namapeminjam
                FROM pengembalian
                JOIN penyewaan ON pengembalian.id_pengembalian = penyewaan.id_penyewaan
                LEFT JOIN 
                customer ON penyewaan.penyewaan_id_customer = customer.id_customer
                WHERE pengembalian.id_pengembalian = '$id_pengembalian'";

    $ambildata = mysqli_query($kon, $data) or die(mysqli_error($kon));
    $nama_peminjam = "";
    if ($row = mysqli_fetch_assoc($ambildata)) {
        $nama_peminjam = $row['namapeminjam'];
    }

    $pdf->Cell(250, 10, "Data Pengembalian Buku - Peminjam: $nama_peminjam", 0, 0, 'R');

    $pdf->Cell(10, 17, '', 0, 1);	
    $pdf->SetFont('Times', 'B', 9);
    $pdf->Cell(10, 7, 'No', 1, 0, 'C');
    $pdf->Cell(30, 7, 'ID Pengembalian', 1, 0, 'C');
    $pdf->Cell(50, 7, 'Nama Peminjam', 1, 0, 'C');
    $pdf->Cell(30, 7, 'Tgl. Pengembalian', 1, 0, 'C');
    $pdf->Cell(70, 7, 'Nama Motor', 1, 0, 'C');
    $pdf->Cell(25, 7, 'Unit', 1, 0, 'C');
    $pdf->Cell(40, 7, 'Denda', 1, 0, 'C');

    $pdf->Cell(10, 7, '', 0, 1);
    $pdf->SetFont('Times', '', 10);

    $no = 1;
    $data = "SELECT pengembalian.id_pengembalian, customer.nama AS namapenyewa,
                penyewaan.tanggal_pinjam, pengembalian.tanggal_pengembalian, 
                CONCAT(kendaraan.brand, ' ', kendaraan.tipe, ' ', kendaraan.tahun) AS motor, 
                pengembalian.stok AS unit, kendaraan.harga_per_hari AS harga, pengembalian.denda,
                DATEDIFF(pengembalian.tanggal_pengembalian, penyewaan.tanggal_balik) AS telat_hari, 
                DATEDIFF(pengembalian.tanggal_pengembalian, penyewaan.tanggal_balik) * kendaraan.harga_per_hari AS total_harga, 
                kendaraan.gambar_motor AS gambar 
                FROM pengembalian
                JOIN penyewaan 
                ON pengembalian.pengembalian_id_penyewaan = penyewaan.id_penyewaan
                LEFT JOIN customer 
                ON penyewaan.penyewaan_id_customer = customer.id_customer
                JOIN garasi 
                ON pengembalian.pengembalian_id_garasi = garasi.id_garasi
                JOIN kendaraan 
                ON garasi.kendaraan_id_motor = kendaraan.id_motor
                WHERE penyewaan.id_penyewaan = '$id_pengembalian'";

    $ambildata = mysqli_query($kon, $data) or die(mysqli_error($kon));
    $num = mysqli_num_rows($ambildata);

    $prevpeminjamanID = null;
    $rowSpanCounts = [];

    if ($num > 0) {
        while ($row = mysqli_fetch_array($ambildata)) {
            $peminjamanID = $row['id_pengembalian'];
            $rowSpanCounts[$peminjamanID][] = $row;
        }

        mysqli_data_seek($ambildata, 0);
        $no = 1;
        foreach ($rowSpanCounts as $peminjamanID => $rows) {
            $rowSpanCount = count($rows);
            $firstRow = true;
            foreach ($rows as $key => $userAmbilData) {
                if ($firstRow) {
                    $pdf->Cell(10, 6 * $rowSpanCount, $no++, 1, 0, 'C');
                    $pdf->Cell(30, 6 * $rowSpanCount, $userAmbilData['id_pengembalian'], 1, 0, 'C');
                    $pdf->Cell(50, 6 * $rowSpanCount, $userAmbilData['namapenyewa'], 1, 0, 'C');
                    $pdf->Cell(30, 6 * $rowSpanCount, $userAmbilData['tanggal_pengembalian'], 1, 0, 'C');
                    $firstRow = false;
                } else {
                    $pdf->Cell(10, 6 * $rowSpanCount, '', 0, 0, 'C');
                    $pdf->Cell(30, 6 * $rowSpanCount, '', 0, 0, 'C');
                    $pdf->Cell(50, 6 * $rowSpanCount, '', 0, 0, 'C');
                    $pdf->Cell(30, 6 * $rowSpanCount, '', 0, 0, 'C');
                }

                $pdf->Cell(70, 6, $userAmbilData['motor'], 1, 0, 'C');
                $pdf->Cell(25, 6, $userAmbilData['unit'], 1, 0, 'C');
                $pdf->Cell(40, 6, 'Rp. ' . $userAmbilData['denda'], 1, 1, 'C');
            }
        }
    }

    $pdf->Output();
?>