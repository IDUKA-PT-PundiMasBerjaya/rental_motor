<?php  
	include_once("../../config/koneksi.php");
	require("../../library/fpdf.php");

	$pdf = new FPDF('L', 'mm', 'A4');
	$pdf->AddPage();

	$pdf->SetFont('Times', 'B', 13);
	$pdf->Cell(0, 15, '', 0, 1);
	$pdf->Cell(250, 10, 'Data Kendaraan', 0, 0, 'R');

	$pdf->Cell(10, 17, '', 0, 1);	
	$pdf->SetFont('Times', 'B', 9);
	$pdf->Cell(10, 7, 'ID', 1, 0, 'C');
	$pdf->Cell(30, 7, 'Brand Motor', 1, 0, 'C');
	$pdf->Cell(30, 7, 'Tipe', 1, 0, 'C');
	$pdf->Cell(30, 7, 'Tahun', 1, 0, 'C');
	$pdf->Cell(30, 7, 'Warna', 1, 0, 'C');
	$pdf->Cell(35, 7, 'Harga per Hari', 1, 0, 'C');

	$pdf->Cell(10, 7, '', 0, 1);
	$pdf->SetFont('Times', '', 10);

	$no = 1;
	$data = mysqli_query($kon, "SELECT * FROM kendaraan ORDER BY id_motor ASC");

	while ($d = mysqli_fetch_array($data)) {
        $pdf->Cell(10, 6, $d['id_motor'], 1, 0, 'C');
		$pdf->Cell(30, 6, $d['brand'], 1, 0, 'C');
		$pdf->Cell(30, 6, $d['tipe'], 1, 0, 'C');
		$pdf->Cell(30, 6, $d['tahun'], 1, 0, 'C');
		$pdf->Cell(30, 6, $d['warna_motor'], 1, 0, 'C');
		$pdf->Cell(35, 6,'Rp. ' . $d['harga_per_hari'] . '/Hari ', 1, 0, 'C');
        $pdf->Ln();
	}

	$pdf->Output();
?>