<?php
include('../fpdf184/fpdf.php');

class PDF extends FPDF
{
// Cabecera de página
function Header()
{
    // Logo
    $this->Image('../Imagenes/reporte.jpg',10,8,33); //loo toca colocar imagen
    $this->Ln(20);
    // Arial bold 15
    $this->SetFont('Arial','B',15);
    // Movernos a la derecha
    $this->Cell(80);
    // Título
    $this->Cell(50,10,'Lista de clientes',0,0,'C');
    // Salto de línea
    $this->Ln(20);
}

// Pie de página
function Footer()
{
    // Posición: a 1,5 cm del final
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Número de página
    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
}


}

include_once('../BaseDatos/connection.php');
$database = new Connection();
$db = $database->open();                      
$sql = 'SELECT * FROM members';

$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial','B',12);
$pdf->Cell(20,10,"Id",1,0,'C',0);
$pdf->Cell(40,10,"firstname",1,0,'C',0);
$pdf->Cell(40,10,"lastname",1,0,'C',0);
$pdf->Cell(60,10,"address",1,1,'C',0);
$pdf->SetFont('Arial','',12);
foreach ($db->query($sql) as $row) {
  $pdf->Cell(20,10,$row['id'],1,0,'C',0);
  $pdf->Cell(40,10,$row['firstname'],1,0,'C',0);
  $pdf->Cell(40,10,$row['lastname'],1,0,'C',0);
  $pdf->Cell(60,10,$row['address'],1,1,'C',0);
}

$pdf->Output();

?>