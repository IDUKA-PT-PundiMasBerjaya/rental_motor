<?php  
	include_once("../../config/koneksi.php");
	require("../../library/fpdf.php");

	$pdf = new FPDF('L', 'mm', 'A4');
	$pdf->AddPage();

	$pdf->SetFont('Times', 'B', 13);
	$pdf->Cell(0, 15, '', 0, 1);
	$pdf->Cell(250, 10, 'Data Garasi', 0, 0, 'R');

	$pdf->Cell(10, 17, '', 0, 1);	
	$pdf->SetFont('Times', 'B', 9);
	$pdf->Cell(20, 7, 'ID Garasi', 1, 0, 'C');
	$pdf->Cell(30, 7, 'Brand Motor', 1, 0, 'C');
	$pdf->Cell(30, 7, 'Tipe', 1, 0, 'C');
	$pdf->Cell(30, 7, 'Tahun', 1, 0, 'C');
	$pdf->Cell(30, 7, 'Warna', 1, 0, 'C');
    $pdf->Cell(30, 7, 'Ketersediaan', 1, 0, 'C');

	$pdf->Cell(10, 7, '', 0, 1);
	$pdf->SetFont('Times', '', 10);

	$no = 1;
	$data = mysqli_query($kon, "SELECT garasi.id_garasi, kendaraan.brand, kendaraan.tipe, kendaraan.tahun,  kendaraan.warna_motor, kendaraan.gambar_motor AS gambar_motor, garasi.ketersediaan
                                FROM kendaraan
                                INNER JOIN garasi
                                ON kendaraan.id_motor = garasi.kendaraan_id_motor
                                ORDER BY id_garasi ASC");

	while ($d = mysqli_fetch_array($data)) {
        $ketersediaan = ($d['ketersediaan'] == 1) ? 'Sedia' : 'Kosong';

        $pdf->Cell(20, 6, $d['id_garasi'], 1, 0, 'C');
		$pdf->Cell(30, 6, $d['brand'], 1, 0, 'C');
		$pdf->Cell(30, 6, $d['tipe'], 1, 0, 'C');
		$pdf->Cell(30, 6, $d['tahun'], 1, 0, 'C');
		$pdf->Cell(30, 6, $d['warna_motor'], 1, 0, 'C');
        $pdf->Cell(30, 6, $ketersediaan, 1, 0, 'C');
        $pdf->Ln();
	}

	$pdf->Output();
?>