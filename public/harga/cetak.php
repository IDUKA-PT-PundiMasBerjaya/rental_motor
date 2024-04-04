<?php  
	include_once("../../config/koneksi.php");
	require("../../library/fpdf.php");

	$pdf = new FPDF('L', 'mm', 'A4');
	$pdf->AddPage();

	$pdf->SetFont('Times', 'B', 13);
	$pdf->Cell(0, 15, '', 0, 1);
	$pdf->Cell(250, 10, 'List Harga Penyewaan Motor', 0, 0, 'R');

	$pdf->Cell(10, 17, '', 0, 1);	
	$pdf->SetFont('Times', 'B', 9);
	$pdf->Cell(20, 7, 'ID Harga', 1, 0, 'C');
	$pdf->Cell(50, 7, 'Motor', 1, 0, 'C');
	$pdf->Cell(30, 7, 'Warna', 1, 0, 'C');
    $pdf->Cell(40, 7, 'Harga per Hari', 1, 0, 'C');

	$pdf->Cell(10, 7, '', 0, 1);
	$pdf->SetFont('Times', '', 10);

	$no = 1;
	$data = mysqli_query($kon, "SELECT harga.id_harga, kendaraan.brand, kendaraan.tipe, kendaraan.tahun,  kendaraan.warna_motor, harga.harga_per_hari
                                FROM kendaraan
                                INNER JOIN harga
                                ON kendaraan.id_motor = harga.kandaraan_id_motor
                                ORDER BY harga.id_harga ASC");

	while ($d = mysqli_fetch_array($data)) {

        $pdf->Cell(20, 6, $d['id_harga'], 1, 0, 'C');
		$pdf->Cell(50, 6, $d['brand'] . ' ' . $d['tipe'] . ' ' . $d['tahun'], 1, 0, 'C');
		$pdf->Cell(30, 6, $d['warna_motor'], 1, 0, 'C');
        $pdf->Cell(40, 6, $d['harga_per_hari'], 1, 0, 'C');
        $pdf->Ln();
	}

	$pdf->Output();
?>