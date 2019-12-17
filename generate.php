<?php
require_once 'header.php';
use setasign\Fpdi\Fpdi;
// TODO check if it is in array 500 1000 2000
$amount = filter_input(INPUT_GET, 'amount');
$EAN = filter_input(INPUT_GET, 'EAN');

?>
<div class="container">
    <?php
    

    $generator = new Picqer\Barcode\BarcodeGeneratorHTML();
    echo $generator->getBarcode($EAN, $generator::TYPE_CODE_128);
    ?>
</div>
<?php


$pdf = new Fpdi();
$pdf->AddPage('L', array(22.86,11.7602));
$filepath = 'assets' . DIRECTORY_SEPARATOR . $amount . '.pdf';

$pageCount = $pdf->setSourceFile($filepath);
$tplIdx = $pdf->importPage(1);
// use the imported page and place it at position 10,10 with a width of 100 mm
$pdf->useTemplate($tplIdx, 0, 0, 228.6);
$pdf->SetFont('Helvetica');
$pdf->SetTextColor(255, 0, 0);
$pdf->SetXY(30, 30);
$pdf->Write(0, 'This is just a simple text');
$pdf->Output('F', "output" . DIRECTORY_SEPARATOR . "output2.pdf");

require_once 'footer.php';