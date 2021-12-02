<?php 
require("fungsilaporan.php");
$tanggalawal = $_GET['tanggalawal'];
$tanggalakhir = $_GET['tanggalakhir'];

require('../fpdf/fpdf.php');
// seperti sebelunya, kita membuat class anakan dari class FPDF
 class PDF extends FPDF{

  function Header(){
   $this->Image('../fpdf/tutorial/logo.png',1,1,2.25); // logo
   $this->SetTextColor(128,0,0); // warna tulisan
   $this->SetFont('Arial','B','12'); // font yang digunakan
   // membuat cell dg panjang 19 dan align center 'C'
   $this->Cell(19,1,'LAPORAN WEB TABUNGAN MAHASISWA',0,0,'C');
   $this->Ln();
   $this->Cell(19,1,'Data Per Periode',0,0,'C');
   $this->Ln();
   $this->SetFont('Arial','B','9');
   $this->SetFillColor(192,192,192); // warna isi
   $this->SetTextColor(0,0,0); // warna teks untuk th
   $this->ln();
   $this->Cell(0.5);
   $this->Cell(1,1,'No',1,0,'L',1); // cell dengan panjang 1
   $this->Cell(2.5,1,'No Transaksi',1,0,'L',1); // cell dengan panjang 3
   $this->Cell(2,1,'Tanggal',1,0,'L',1); // cell dengan panjang 3
   $this->Cell(4,1,'Nama',1,0,'L',1); // cell dengan panjang 4
   $this->Cell(3,1,'Jenis Transaksi',1,0,'L',1); // cell dengan panjang 4
   $this->Cell(3,1,'Debit',1,0,'L',1); // cell dengan panjang 4
   $this->Cell(3,1,'Kredit',1,0,'L',1); // cell dengan panjang 4
   // panjang cell bisa disesuaikan
   $this->Ln();
  }

  function Footer(){
   $this->SetY(-2,5);
   $this->Cell(0,1,$this->PageNo(),0,0,'C');
  } 
 }

 //  ambil data
 $mahasiswa = caria($tanggalawal,$tanggalakhir);
 // $debit = $mahasiswa[0]["Debet"];
 // $kredit = $mahasiswa[0]["Kredit"];
 // $totalkas = $debit - $kredit;
 // $mahadewa = carib($tanggalawal,$tanggalakhir);
  $j = 1;
 // orientasi Potrait
 // ukuran cm
 // kertas A4
 $pdf = new PDF('P','cm','A4');
 $pdf->Open();
 $pdf->AliasNbPages();
 $pdf->AddPage();

 $pdf->SetFont('Arial','','8');
 //perulangan untuk membuat tabel
 foreach ($mahasiswa as $row) :
  $pdf->Cell(0.5);
  $pdf->Cell(1,1,$j++,1,0,'C');
  $pdf->Cell(2.5,1,$row["No_Transaksi"],1,0,'C');
  $pdf->Cell(2,1,$row["Tanggal"],1,0,'L');
  $pdf->Cell(4,1,$row["Nama"],1,0,'L');
  $pdf->Cell(3,1,$row["Jenis_Transaksi"],1,0,'L');
  $pdf->Cell(3,1,rupiah($row["Debet"]),1,0,'L');
  $pdf->Cell(3,1,rupiah($row["Kredit"]),1,0,'L');
  $pdf->Ln();
 endforeach;
 $pdf->Output(); // ditampilkan

?>