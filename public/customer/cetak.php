<?php  
	include_once("../../config/koneksi.php");
	require("../../library/fpdf.php");

	$pdf = new FPDF('L', 'mm', 'A4');
	$pdf->AddPage();

	$pdf->SetFont('Times', 'B', 13);
	$pdf->Cell(0, 15, '', 0, 1);
	$pdf->Cell(250, 10, 'Data Customer', 0, 0, 'R');

	$pdf->Cell(10, 17, '', 0, 1);	
	$pdf->SetFont('Times', 'B', 9);
	$pdf->Cell(30, 7, 'ID Customer', 1, 0, 'C');
	$pdf->Cell(60, 7, 'Nama', 1, 0, 'C');
	$pdf->Cell(50, 7, 'Email', 1, 0, 'C');
	$pdf->Cell(40, 7, 'No. Telp', 1, 0, 'C');
	$pdf->Cell(50, 7, 'Alamat', 1, 0, 'C');

	$pdf->Cell(10, 7, '', 0, 1);
	$pdf->SetFont('Times', '', 10);

	$no = 1;
	$data = mysqli_query($kon, "SELECT * FROM customer ORDER BY id_customer ASC");

	while ($d = mysqli_fetch_array($data)) {
        $pdf->Cell(30, 6, $d['id_customer'], 1, 0, 'C');
		$pdf->Cell(60, 6, $d['nama'], 1, 0, 'C');
		$pdf->Cell(50, 6, $d['email'], 1, 0, 'C');
		$pdf->Cell(40, 6, $d['no_telp'], 1, 0, 'C');
		$pdf->Cell(50, 6, $d['alamat'], 1, 0, 'C');
        $pdf->Ln();
	}

	$pdf->Output();
?>