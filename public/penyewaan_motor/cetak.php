<?php
    include_once("../../config/koneksi.php");
    require("../../library/fpdf.php");

    $pdf = new FPDF('L', 'mm', 'A4');
    $pdf->AddPage();

    $pdf->SetFont('Times', 'B', 13);
    $pdf->Cell(0, 15, '', 0, 1);
    $pdf->Cell(250, 10, 'Data Penyewaan Motor', 0, 0, 'R');

    $pdf->Cell(10, 17, '', 0, 1);	
    $pdf->SetFont('Times', 'B', 9);
    $pdf->Cell(10, 7, 'No', 1, 0, 'C');
    $pdf->Cell(30, 7, 'ID Penyewaan', 1, 0, 'C');
    $pdf->Cell(50, 7, 'Nama Peminjam', 1, 0, 'C');
    $pdf->Cell(30, 7, 'Tgl. Peminjaman', 1, 0, 'C');
    $pdf->Cell(30, 7, 'Tgl. Pengembalian', 1, 0, 'C');
    $pdf->Cell(70, 7, 'Nama Motor', 1, 0, 'C');
    $pdf->Cell(25, 7, 'Unit', 1, 0, 'C');

    $pdf->Cell(10, 7, '', 0, 1);
    $pdf->SetFont('Times', '', 10);

    $no = 1;
    $data = "SELECT penyewaan_motor.id_penyewaan, 
                CASE 
                    WHEN customer.nama IS NOT NULL THEN customer.nama 
                END AS namapenyewa,
                penyewaan.tanggal_pinjam, penyewaan.tanggal_balik, 
                CONCAT(kendaraan.brand, ' ', kendaraan.tipe, ' ', kendaraan.tahun) AS motor,  
                penyewaan_motor.stok AS unit, kendaraan.harga_per_hari AS harga, 
                kendaraan.gambar_motor AS gambar 
                FROM penyewaan_motor
                JOIN penyewaan 
                ON penyewaan_motor.id_penyewaan = penyewaan.id_penyewaan
                LEFT JOIN customer 
                ON penyewaan.penyewaan_id_customer = customer.id_customer
                JOIN garasi 
                ON penyewaan_motor.penyewaan_id_garasi = garasi.id_garasi
                JOIN kendaraan 
                ON garasi.kendaraan_id_motor = kendaraan.id_motor
                ORDER BY id_penyewaan ASC";

    $ambildata = mysqli_query($kon, $data) or die(mysqli_error($kon));
    $num = mysqli_num_rows($ambildata);

    $prevpeminjamanID = null;
    $rowSpanCounts = [];

    if ($num > 0) {
        while ($row = mysqli_fetch_array($ambildata)) {
            $peminjamanID = $row['id_penyewaan'];
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
                $pdf->Cell(30, 6 * $rowSpanCount, $userAmbilData['id_penyewaan'], 1, 0, 'C');
                    $pdf->Cell(50, 6 * $rowSpanCount, $userAmbilData['namapenyewa'], 1, 0, 'C');
                    $firstRow = false;
                } else {
                    $pdf->Cell(10, 6 * $rowSpanCount, '', 0, 0, 'C');
                    $pdf->Cell(30, 6 * $rowSpanCount, '', 0, 0, 'C');
                    $pdf->Cell(50, 6 * $rowSpanCount, '', 0, 0, 'C');
                }

                $pdf->Cell(30, 6, $userAmbilData['tanggal_pinjam'], 1, 0, 'C');
                $pdf->Cell(30, 6, $userAmbilData['tanggal_balik'], 1, 0, 'C');
                $pdf->Cell(70, 6, $userAmbilData['motor'], 1, 0, 'C');
                $pdf->Cell(25, 6, $userAmbilData['unit'], 1, 1, 'C');
            }
        }
    }

    $pdf->Output();
?>