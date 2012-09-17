<?php
require('alphapdf.php');

$pdf = new AlphaPDF();
$pdf->AddPage();
$pdf->SetLineWidth(1.5);

// draw opaque red square
$pdf->SetFillColor(255,0,0);
$pdf->Rect(10,10,40,40,'DF');

// set alpha to semi-transparency
$pdf->SetAlpha(0.5);

// draw green square
$pdf->SetFillColor(0,255,0);
$pdf->Rect(20,20,40,40,'DF');

// draw jpeg image
$pdf->Image('lena.jpg',30,30,40);

// restore full opacity
$pdf->SetAlpha(1);

// print name
$pdf->SetFont('Arial', '', 12);
$pdf->Text(46,68,'Lena');

$pdf->Output();
?>
