<?php
// memanggil library FPDF
require('../fpdf/fpdf.php');

// intance object dan memberikan pengaturan halaman PDF
$pdf = new FPDF('l','mm','A4');
// membuat halaman baru
$pdf->AddPage();
// setting jenis font yang akan digunakan
$pdf->SetFont('Arial','B',16);
// mencetak string 
$pdf->Cell(280,7,'DAFTAR CALON SISWA SMK CODING',0,1,'C');
// Memberikan space kebawah agar tidak terlalu rapat
$pdf->Cell(10,7,'',0,1);

// membuat header tabel
$pdf->SetFont('Arial','B',12);
$pdf->Cell(10,6,'ID',1,0,'C');
$pdf->Cell(64,6,'NAMA',1,0,'C');
$pdf->Cell(75,6,'ALAMAT',1,0,'C');
$pdf->Cell(34,6,'JENIS KELAMIN',1,0,'C');
$pdf->Cell(30,6,'AGAMA',1,0,'C');
$pdf->Cell(64,6,'SEKOLAH ASAL',1,1,'C');

// untuk koneksi ke database
include ("config.php");
// melakukan query untuk mengambil seluruh data calon siswa
$query = "SELECT * FROM calon_siswa";
$result = mysqli_query($db, $query);
if(!$result){
    die("Gagal mengambil data");
}
// query berhasil, tambahkan data tersebut pada pdf
$pdf->SetFont('Arial', '', 12);
while($siswa = mysqli_fetch_array($result)){
    $pdf->Cell(10,6,$siswa['id'],1,0);
    $pdf->Cell(64,6,$siswa['nama'],1,0);
    $pdf->Cell(75,6,$siswa['alamat'],1,0);
    $pdf->Cell(34,6,$siswa['jenis_kelamin'],1,0);
    $pdf->Cell(30,6,$siswa['agama'],1,0);
    $pdf->Cell(64,6,$siswa['sekolah_asal'],1,1);
}
// selesai
$pdf->Output();
?>