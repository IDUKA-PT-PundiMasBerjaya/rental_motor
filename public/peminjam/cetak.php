<?php  
	include_once("../../config/koneksi.php");
	require("../../library/fpdf.php");

	$pdf = new FPDF('L', 'mm', 'A4');
	$pdf->AddPage();

	$pdf->SetFont('Times', 'B', 13);
	$pdf->Cell(0, 15, '', 0, 1);
	$pdf->Cell(250, 10, 'Data Peminjam', 0, 0, 'R');

	$pdf->Cell(10, 17, '', 0, 1);	
	$pdf->SetFont('Times', 'B', 9);
	$pdf->Cell(27, 7, 'ID Peminjam', 1, 0, 'C');
	$pdf->Cell(50, 7, 'Nama Peminjam', 1, 0, 'C');
	$pdf->Cell(35, 7, 'Tgl. Peminjaman', 1, 0, 'C');
	$pdf->Cell(35, 7, 'Tgl. Pengembalian', 1, 0, 'C');

	$pdf->Cell(10, 7, '', 0, 1);
	$pdf->SetFont('Times', '', 10);

	$no = 1;
	$data = mysqli_query($kon, "SELECT peminjam.id_peminjam, customer.nama AS namapeminjam, peminjam.tanggal_pinjam, peminjam.tanggal_balik FROM peminjam
                                LEFT JOIN customer ON peminjam.peminjam_id_customer = customer.id_customer
                                ORDER BY peminjam.id_peminjam ASC");

	while ($d = mysqli_fetch_array($data)) {
        $pdf->Cell(27, 6, $d['id_peminjam'], 1, 0, 'C');
		$pdf->Cell(50, 6, $d['namapeminjam'], 1, 0, 'C');
		$pdf->Cell(35, 6, $d['tanggal_pinjam'], 1, 0, 'C');
		$pdf->Cell(35, 6, $d['tanggal_balik'], 1, 0, 'C');
        $pdf->Ln();
	}

	$pdf->Output();
?>